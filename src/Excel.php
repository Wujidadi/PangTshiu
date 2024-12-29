<?php

namespace Wujidadi\Pangtshiu;

use InvalidArgumentException;

/**
 * Utility class for handling Excel-related conversions.
 */
class Excel
{
    /**
     * Excel column letters.
     */
    public const COLUMN_CHAR = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z',
    ];

    /**
     * Reverse lookup for COLUMN_CHAR.
     */
    public const CHAR_TO_NUMBER = [
        'A' => 1,  'B' => 2,  'C' => 3,  'D' => 4,  'E' => 5,  'F' => 6,  'G' => 7,  'H' => 8,  'I' => 9,  'J' => 10,
        'K' => 11, 'L' => 12, 'M' => 13, 'N' => 14, 'O' => 15, 'P' => 16, 'Q' => 17, 'R' => 18, 'S' => 19, 'T' => 20,
        'U' => 21, 'V' => 22, 'W' => 23, 'X' => 24, 'Y' => 25, 'Z' => 26,
    ];

    public const MAX_COLUMN_NUMBER = 16384;

    /**
     * Convert Excel column letters to a number.
     *
     * @param string $column column letters (e.g., 'A', 'Z', 'AA')
     * @return int corresponding number (e.g., 1, 26, 27)
     * @throws InvalidArgumentException if the input column letters are invalid
     */
    public static function columnToNumber(string $column): int
    {
        if ($column === '') {
            throw new InvalidArgumentException('Column letters must be a non-empty string');
        }

        $column = strtoupper($column);
        $length = strlen($column);
        $number = 0;

        for ($i = 0; $i < $length; $i++) {
            $char = $column[$i];
            if (!isset(self::CHAR_TO_NUMBER[$char])) {
                throw new InvalidArgumentException("Invalid column letters: $column");
            }
            $number = $number * 26 + self::CHAR_TO_NUMBER[$char];
        }

        if ($number > self::MAX_COLUMN_NUMBER) {
            throw new InvalidArgumentException("Column number exceeds maximum limit: $column");
        }

        return $number;
    }

    /**
     * Convert a number to Excel column letters.
     *
     * @param int $number column number (e.g., 1, 26, 27)
     * @return string corresponding column letters (e.g., 'A', 'Z', 'AA')
     * @throws InvalidArgumentException if the input number is invalid
     */
    public static function numberToColumn(int $number): string
    {
        if ($number < 1 || $number > self::MAX_COLUMN_NUMBER) {
            throw new InvalidArgumentException("Invalid column number: $number");
        }

        $column = [];
        while ($number > 0) {
            $mod = ($number - 1) % 26;
            $column[] = self::COLUMN_CHAR[$mod];
            $number = (int) (($number - $mod) / 26);
        }

        return implode('', array_reverse($column));
    }
}
