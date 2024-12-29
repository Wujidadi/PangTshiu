<?php

namespace Wujidadi\Pangtshiu;

/**
 * Utility class for handling JSON data.
 */
class Json
{
    /**
     * Encode a given data into JSON format with special characters and slashes unescaped.
     *
     * @param array|object $data the data to encode
     * @return bool|string the encoded JSON string, or false on failure
     */
    public static function unescape(array|object $data): bool|string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Pretty print a given data into JSON format with special characters and slashes unescaped.
     *
     * @param array|object $data the data to encode and pretty print
     * @param bool $compact whether to make the output compact (2 spaces indentation)
     * @return bool|string the pretty printed JSON string, or false on failure
     */
    public static function prettyPrint(array|object $data, bool $compact = false): bool|string
    {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        if (!$compact) {
            return $json;
        }
        return preg_replace_callback('/^( +)/m', function ($matches) {
            return str_repeat(' ', strlen($matches[1]) / 2);
        }, $json);
    }
}
