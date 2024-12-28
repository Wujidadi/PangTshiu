<?php

namespace Wujidadi\Pangtshiu;

use InvalidArgumentException;

/**
 * Utility class handling Base62 numbers.
 */
class Base62
{
    /**
     * Base62 character set in ASCII order.
     */
    public const DICT = [
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];

    /**
     * Reverse lookup for DICT.
     */
    public const REVERSE_DICT = [
        '0' => 0,  '1' => 1,  '2' => 2,  '3' => 3,  '4' => 4,  '5' => 5,  '6' => 6,  '7' => 7,  '8' => 8,  '9' => 9,
        'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19,
        'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29,
        'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35,
        'a' => 36, 'b' => 37, 'c' => 38, 'd' => 39, 'e' => 40, 'f' => 41, 'g' => 42, 'h' => 43, 'i' => 44, 'j' => 45,
        'k' => 46, 'l' => 47, 'm' => 48, 'n' => 49, 'o' => 50, 'p' => 51, 'q' => 52, 'r' => 53, 's' => 54, 't' => 55,
        'u' => 56, 'v' => 57, 'w' => 58, 'x' => 59, 'y' => 60, 'z' => 61,
    ];

    /**
     * Generates a random Base62 string with variable length controlled by the parameter.
     */
    public static function string(int $length = 8): string
    {
        $dictLength = count(self::DICT) - 1;

        $result = [];
        for ($i = 0; $i < $length; $i++) {
            $rand = random_int(0, $dictLength);
            $result[] = self::DICT[$rand];
        }

        return implode('', $result);
    }

    /**
     * Converts a decimal number to a Base62 number string.
     */
    public static function decToBase62(float|int|string $num): string
    {
        $to = count(self::DICT);
        $result = [];

        do {
            $result[] = self::DICT[bcmod($num, $to)];
            $num = bcdiv($num, $to);
        } while (bccomp($num, '0') > 0);

        return implode('', array_reverse($result));
    }

    /**
     * Converts a Base62 number string to a decimal number string.
     */
    public static function base62ToDec(string $num): string
    {
        $from = count(self::DICT);
        $len = strlen($num);
        $dec = '0';

        for ($i = 0; $i < $len; $i++) {
            $pos = self::REVERSE_DICT[$num[$i]] ?? null;
            if ($pos === null) {
                throw new InvalidArgumentException("Invalid character in Base62 string: $num[$i]");
            }
            $dec = bcadd(bcmul(bcpow($from, $len - $i - 1), $pos), $dec);
        }

        return $dec;
    }
}
