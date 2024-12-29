<?php

namespace Wujidadi\Pangtshiu;

/**
 * Utility class built on PHP's base64 functions, adding features and encapsulation.
 */
class Base64
{
    /**
     * Encodes the input string to a URL-safe Base64 format.
     *
     * @param string $string the input string to encode
     * @return string the encoded string in URL-safe Base64 format
     */
    public static function urlSafeEncode(string $string): string
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    /**
     * Decodes a URL-safe Base64 string back to its original value.
     *
     * @param string $string the URL-safe Base64 string to decode
     * @param bool $strict returns false if input contains character from outside the base64 alphabet
     * @return string the decoded string
     */
    public static function urlSafeDecode(string $string, bool $strict = false): string
    {
        return base64_decode(strtr($string, '-_', '+/'), $strict);
    }
}
