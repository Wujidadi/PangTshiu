<?php

namespace Wujidadi\Pangtshiu;

/**
 * Utility Class for handling TGUID (Time-sequential GUID).
 */
class TGuid
{
    /**
     * Generate a Base62 TGUID with additional padding to meet 42 characters.
     *
     * 42, the Answer to the Ultimate Question of Life, The Universe, and Everything!
     *
     * @param bool $withDash include dashes in the output
     * @return string the TGUID with 42 characters (dashes not included)
     * @throws \Random\RandomException if an appropriate source of randomness cannot be found
     */
    public static function create(bool $withDash = false): string
    {
        // Generate the base TGUID
        $baseTGuid = self::base62TGuid($withDash);

        // Determine the total length needed
        $requiredLength = $withDash ? 48 : 42;

        // Calculate the remaining characters needed
        $remainingLength = $requiredLength - strlen($baseTGuid);

        // Generate random Base62 characters to fill the gap if needed
        $padding = $remainingLength > 0
            ? implode('', array_map(fn () => Base62::DICT[random_int(0, 61)], range(1, $remainingLength)))
            : '';

        // Append the padding to the base TGUID
        return $withDash ? $baseTGuid . '-' . $padding : $baseTGuid . $padding;
    }

    /**
     * Generate a UUID by combining uniqid and a standard GUID.
     *
     * @return string a UUID
     * @throws \Random\RandomException if an appropriate source of randomness cannot be found
     */
    public static function uuid(): string
    {
        $unid = uniqid() . str_replace('-', '', Guid::create());
        return implode('-', [
            substr($unid, 0, 8),
            substr($unid, 8, 4),
            substr($unid, 12, 4),
            substr($unid, 16, 4),
            substr($unid, 20, 12),
        ]);
    }

    /**
     * Generate a hexadecimal TGUID with 54 characters (60 includes dashes).
     *
     * @return string a TGUID with 16 characters
     * @throws \Random\RandomException if an appropriate source of randomness cannot be found
     */
    private static function tGuid16(): string
    {
        return str_replace('.', '-', uniqid('', true)) . '-' . Guid::create();
    }

    /**
     * Generate a GUID in Base62 encoding.
     *
     * @param bool $withDash include dashes in the output
     * @return string the Base62 encoded GUID
     * @throws \Random\RandomException if an appropriate source of randomness cannot be found
     */
    public static function base62Guid(bool $withDash = false): string
    {
        $guidHex = explode('-', Guid::create());
        $base62Parts = [];

        foreach ($guidHex as $index => $part) {
            $padLength = match ($index) {
                0 => 6,
                1, 2, 3 => 3,
                4 => 9,
                default => 0,
            };

            $base62 = Base62::decToBase62(hexdec($part));
            $base62Parts[] = str_pad($base62, $padLength, '0', STR_PAD_LEFT);
        }

        return implode($withDash ? '-' : '', $base62Parts);
    }

    /**
     * Generate a TGUID in Base62 encoding.
     *
     * @param bool $withDash include dashes in the output
     * @return string the Base62 encoded TGUID
     * @throws \Random\RandomException if an appropriate source of randomness cannot be found
     */
    public static function base62TGuid(bool $withDash = false): string
    {
        $tGuidParts = explode('-', self::tGuid16());
        $base62Parts = [];

        foreach ($tGuidParts as $index => $part) {
            $padLength = match ($index) {
                0 => 10,
                1 => 8,
                2 => 6,
                3, 4, 5 => 3,
                6 => 9,
                default => 0,
            };

            $base62 = $index === 1 ? $part : Base62::decToBase62(hexdec($part));
            $base62Parts[] = str_pad($base62, $padLength, '0', STR_PAD_LEFT);
        }

        $string = implode($withDash ? '-' : '', $base62Parts);
        $threshold = $withDash ? 48 : 42;
        if (strlen($string) > $threshold) {
            $string = substr($string, 0, $threshold);
        }

        return $string;
    }

    /**
     * Convert a Base62 TGUID to a UTC datetime.
     *
     * The maximum detectable time is `3555-04-08 14:09:22.133048` (`zzzzzzzzzz` in Base62).
     * Beyond that point, the time will reset to the epoch `1995-07-27 19:27:14.148270`.
     *
     * @param string $tGuid the TGUID
     * @return string|null datetime string in `Y-m-d H:i:s.u` format
     */
    public static function tGuidToTime(string $tGuid): ?string
    {
        $base62Part = substr($tGuid, 0, 10);
        $timestampDecimal = Base62::base62ToDec($base62Part);
        $timestampHex = gmp_strval(gmp_init($timestampDecimal, 10), 16);

        $is64Bit = strlen($timestampHex) > 8;
        $secondsHex = substr($timestampHex, 0, $is64Bit ? -6 : -5);
        $microsecondsHex = substr($timestampHex, $is64Bit ? -6 : -5);

        $timestampSeconds = hexdec($secondsHex);
        $timestampMicroseconds = str_pad((string) hexdec($microsecondsHex), 6, '0', STR_PAD_LEFT);

        return date('Y-m-d H:i:s', $timestampSeconds) . '.' . $timestampMicroseconds;
    }

    /**
     * Convert a datetime string into a Base62 number string just like the first 10 characters of a TGUID.
     *
     * If no datetime is provided, the current time with microseconds is used.
     * The resulting Base62 value represents both the second-level and microsecond-level parts of the datetime.
     *
     * @param string|null $time an ISO-formatted datetime string with microseconds (e.g., "2024-12-31 23:59:59.123456")
     * @return string|null a 10-character Base62 string, or null if the input time is invalid
     */
    public static function timeToTGuid(?string $time = null): ?string
    {
        // Use current timestamp with microseconds if no time is provided
        $time ??= date('Y-m-d H:i:s.u');

        // Ensure the input matches the expected ISO format with microseconds
        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}(\.\d{1,6})?$/', $time)) {
            return null;
        }

        // Split the time into seconds and microseconds
        [$date, $microtime] = array_pad(explode('.', $time), 2, '0');
        $timestampSeconds = strtotime($date);
        $timestampHex = dechex($timestampSeconds);

        // Convert microseconds to hexadecimal, ensuring it is padded to 6 characters
        $microtimeHex = str_pad(dechex((int) $microtime), 6, '0', STR_PAD_LEFT);

        // Combine the hexadecimal seconds and microseconds
        $protoHex = $timestampHex . $microtimeHex;

        // Convert the combined hexadecimal string into Base62
        $base62 = Base62::decToBase62(gmp_strval(gmp_init($protoHex, 16)));

        // Ensure the result is exactly 10 characters long, padding with zeros if necessary
        return str_pad($base62, 10, '0', STR_PAD_LEFT);
    }
}
