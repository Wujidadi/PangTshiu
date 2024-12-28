<?php

namespace Wujidadi\Pangtshiu;

/**
 * Utility class built on PHP's base64 functions, adding features and encapsulation.
 */
class Base64
{
    /**
     * Encodes the input string to a URL-safe Base64 format.
     */
    public static function urlSafeEncode(string $string): string
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    /**
     * Decodes a URL-safe Base64 string back to its original value.
     */
    public static function urlSafeDecode(string $string, bool $strict = false): string
    {
        return base64_decode(strtr($string, '-_', '+/'), $strict);
    }
}
