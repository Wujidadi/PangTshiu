<?php

use Wujidadi\Pangtshiu\Format\Date;

it('is legal Y-m-d H:i:s format', function (string $dateTime, bool $isLegal) {
    expect(Date::ymdhis($dateTime))->toBe($isLegal);
})->with([
    ['2022-01-01 12:34:56', true],
    ['2023-13-01 12:34:56', false],
    ['2025-01-01@22:34:56', false],
    ['2025-01-01 30:64:05', false],
    ['-185-01-01 07:32:40', true],
    ['1956-08-01 17:17:61', false],
    ['1962-10-34 15:23:48', false],
]);

it('is leap year', function (int $year, bool $isLeapYeay) {
    expect(Date::isLeapYear($year))->toBe($isLeapYeay);
})->with([
    [-200, false],
    [-99, false],
    [-44, true],
    [0, true],
    [1000, false],
    [1600, true],
    [1900, false],
    [1999, false],
    [2000, true],
    [2001, false],
    [2004, true],
    [2025, false],
    [2100, false],
    [2400, true],
    [2800, true],
    [2900, false],
    [3200, false],
    [3204, true],
    [3600, true],
]);

it('is legal day', function (int $year, int $month, int $day, bool $isLegal) {
    expect(Date::isLegalDate($year, $month, $day))->toBe($isLegal);
})->with([
    [2000, 2, 29, true],
    [2000, 4, 31, false],
    [2020, 2, 30, false],
    [2021, 2, 29, false],
    [2022, 3, 31, true],
    [2022, 6, 31, false],
    [2024, 5, 30, true],
    [2024, 6, 31, false],
    [2025, 6, 30, true],
    [2027, 9, 31, false],
    [2029, 9, 30, true],
    [2100, 2, 29, false],
    [10000, 2, 29, true],
    [10086, 13, 47, false],
]);

it('is legal time', function (int $hour, int $minute, int $second, bool $isLegal) {
    expect(Date::isLegalTime($hour, $minute, $second))->toBe($isLegal);
})->with([
    [0, 0, 0, true],
    [12, 31, 57, true],
    [23, 59, 59, true],
    [-1, 0, 0, false],
    [14, 87, 65, false],
]);
