<?php

namespace Wujidadi\Pangtshiu\Format;

/**
 * Utility class for validating and parsing date-time strings.
 */
class Date
{
    /**
     * Numbers of months with 31 days.
     */
    public const LONG_MONTHS = [1, 3, 5, 7, 8, 10, 12];

    /**
     * Numbers of months with 30 days.
     */
    public const SHORT_MONTHS = [4, 6, 9, 11];

    /**
     * Validate a datetime string in 'Y-m-d H:i:s' format, including BCE years.
     *
     * @param string $dateTime the datetime string to validate
     * @return bool true if the datetime is valid, false otherwise
     */
    public static function ymdhis(string $dateTime): bool
    {
        if (!self::isValidFormat($dateTime)) {
            return false;
        }

        [$date, $time] = explode(' ', $dateTime);
        [$year, $month, $day] = self::parseDate($date);
        [$hour, $minute, $second] = self::parseTime($time);

        if (!self::isLegalDate($year, $month, $day)) {
            return false;
        }

        if (!self::isLegalTime($hour, $minute, $second)) {
            return false;
        }

        return true;
    }

    /**
     * Check if the datetime string matches the required 'Y-m-d H:i:s' format.
     *
     * @param string $dateTime the datetime string to validate
     * @return bool true if the format is valid, false otherwise
     */
    private static function isValidFormat(string $dateTime): bool
    {
        $regex = '/^-?\d+-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';
        return (bool) preg_match($regex, $dateTime);
    }

    /**
     * Parse a date string in 'Y-m-d' pattern into an array containing year, month, and day as integers.
     *
     * @param string $date the date string to parse
     * @return int[] an array containing year, month, and day as integers
     */
    private static function parseDate(string $date): array
    {
        preg_match('/^(-?\d+)-(\d{1,2})-(\d{1,2})$/', $date, $matches);
        return [
            (int) $matches[1],
            (int) $matches[2],
            (int) $matches[3],
        ];
    }

    /**
     * Parse a time string in 'H:i:s' pattern into an array containing hour, minute, and second as integers.
     *
     * @param string $time the time string to parse
     * @return int[] an array containing hour, minute, and second as integers
     */
    private static function parseTime(string $time): array
    {
        $timeArray = explode(':', $time);
        return [
            (int) $timeArray[0],
            (int) $timeArray[1],
            (int) $timeArray[2],
        ];
    }

    /**
     * Determine if a year is a leap year.
     *
     * @param int $year the year to check
     * @return bool true if it is a leap year, false otherwise
     */
    public static function isLeapYear(int $year): bool
    {
        // 3200, 6400 are not leap years (BCE years not included)
        if ($year > 0 && $year % 3200 === 0) {
            return false;
        }

        // 1600, 2000, 2400, 2800 are leap years
        if ($year % 400 === 0) {
            return true;
        }

        // 1900, 2100, 2300 are not leap years
        if ($year % 100 === 0) {
            return false;
        }

        if ($year % 4 === 0) {
            return true;
        }

        return false;
    }

    /**
     * Validate if a given date is legal.
     *
     * @param int $year the year to validate
     * @param int $month the month to validate
     * @param int $day the day to validate
     * @return bool true if the date is valid, false otherwise
     */
    public static function isLegalDate(int $year, int $month, int $day): bool
    {
        if (self::isInvalidMonth($month)) {
            return false;
        }

        if (self::isInvalidDayInMonth($day, $month)) {
            return false;
        }

        $isLeapYear = self::isLeapYear($year);
        if (self::isInvalidLeapDate($day, $month, $isLeapYear)) {
            return false;
        }

        return true;
    }

    /**
     * Check if the month is invalid.
     *
     * @param int $month the month to validate
     * @return bool true if the month is invalid, false otherwise
     */
    private static function isInvalidMonth(int $month): bool
    {
        return $month < 1 || $month > 12;
    }

    /**
     * Check if the day exceeds the maximum days allowed for the given month.
     *
     * @param int $day the day to validate
     * @param int $month the month to validate
     * @return bool true if the day is invalid, false otherwise
     */
    private static function isInvalidDayInMonth(int $day, int $month): bool
    {
        if (in_array($month, self::LONG_MONTHS) && $day > 31) {
            return true;
        }
        if (in_array($month, self::SHORT_MONTHS) && $day > 30) {
            return true;
        }
        return false;
    }

    /**
     * Check if the day is invalid for February considering leap years.
     *
     * @param int $day the day to validate
     * @param int $month the month to validate
     * @param bool $isLeapYear whether the year is a leap year
     * @return bool true if the day is invalid, false otherwise
     */
    private static function isInvalidLeapDate(int $day, int $month, bool $isLeapYear): bool
    {
        if ($isLeapYear && $month === 2 && $day > 29) {
            return true;
        }
        if (!$isLeapYear && $month === 2 && $day > 28) {
            return true;
        }
        return false;
    }

    /**
     * Validate if a given time is legal.
     *
     * @param int $hour the hour to validate
     * @param int $minute the minute to validate
     * @param int $second the second to validate
     * @return bool true if the time is valid, false otherwise
     */
    public static function isLegalTime(int $hour, int $minute, int $second): bool
    {
        if ($hour < 0 || $hour > 23) {
            return false;
        }
        if ($minute < 0 || $minute > 59) {
            return false;
        }
        if ($second < 0 || $second > 59) {
            return false;
        }
        return true;
    }
}
