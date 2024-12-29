<?php

namespace Wujidadi\Pangtshiu;

/**
 * Utility class for generating GUIDs (Globally Unique Identifiers).
 *
 * Based on [Sujip Thapa's version](https://github.com/sudiptpa/guid/blob/master/src/Guid.php).
 */
class Guid
{
    /**
     * Generates a GUID.
     *
     * @param bool $trim whether to trim the curly braces from the GUID
     * @return string the generated GUID
     * @throws \Random\RandomException if an appropriate source of randomness cannot be found
     */
    public static function create(bool $trim = true): string
    {
        // Windows platform
        if (function_exists('com_create_guid')) {
            $guid = com_create_guid();
            return $trim ? trim($guid, '{}') : $guid;
        }

        // macOS/Linux platform
        if (function_exists('openssl_random_pseudo_bytes')) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0F | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3F | 0x80); // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback using random_bytes
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0F | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3F | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Checks if a given GUID is valid.
     *
     * @param string $guid the GUID to check
     * @return bool true if the GUID is valid, false otherwise
     */
    public static function isLegal(string $guid): bool
    {
        $alphanumeric = '[0-9A-Fa-f]';
        $pattern = "/^$alphanumeric{8}-$alphanumeric{4}-$alphanumeric{4}-$alphanumeric{4}-$alphanumeric{12}$/";
        return (bool) preg_match($pattern, $guid);
    }
}
