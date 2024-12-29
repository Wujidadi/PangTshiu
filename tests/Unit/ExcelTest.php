<?php

use Wujidadi\Pangtshiu\Excel;

test('column to number', function (string $colum, int $number) {
    expect(Excel::columnToNumber($colum))->toBe($number);
})->with([
    ['A', 1],
    ['W', 23],
    ['AA', 27],
    ['ZZ', 702],
    ['AAA', 703],
    ['XFD', 16384],
]);

it('should throw exception while converting invalid column', function (string $column, string $message) {
    try {
        Excel::columnToNumber($column);
    } catch (Throwable $e) {
        expect($e::class)->toBe(InvalidArgumentException::class)
            ->and($e->getMessage())->toBe($message);
    }
})->with([
    ['', 'Column letters must be a non-empty string'],
    ['ZZZ', 'Column number exceeds maximum limit: ZZZ'],
    ['123', 'Invalid column letters: 123'],
    ['XFD1', 'Invalid column letters: XFD1'],
]);

test('number to column', function (int $number, string $column) {
    expect(Excel::numberToColumn($number))->toBe($column);
})->with([
    [1, 'A'],
    [26, 'Z'],
    [27, 'AA'],
    [702, 'ZZ'],
    [703, 'AAA'],
    [16384, 'XFD'],
]);

it('should throw exception while converting invalid number', function (int $number, string $message) {
    try {
        Excel::numberToColumn($number);
    } catch (Throwable $e) {
        expect($e::class)->toBe(InvalidArgumentException::class)
            ->and($e->getMessage())->toBe($message);
    }
})->with([
    [0, 'Invalid column number: 0'],
    [-1, 'Invalid column number: -1'],
    [16385, 'Invalid column number: 16385'],
]);
