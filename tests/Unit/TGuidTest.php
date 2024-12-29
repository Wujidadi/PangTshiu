<?php

use Wujidadi\Pangtshiu\TGuid;

test('create TGUID', function () {
    $tguid = TGuid::create();
    expect($tguid)
        ->toBeString()
        ->and(strlen($tguid))->toBe(42)
        ->and(preg_match('/^[0-9A-Za-z]{42}$/', $tguid))->toBe(1);

    $tguidWithDash = TGuid::create(true);
    expect($tguidWithDash)
        ->toBeString()
        ->and(strlen($tguidWithDash))->toBe(49)
        ->and(preg_match('/^[0-9A-Za-z\-]{49}$/', $tguidWithDash))->toBe(1);
});

test('generate UUID', function () {
    $uuid = TGuid::uuid();
    expect($uuid)
        ->toBeString()
        ->and(preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $uuid))->toBe(1);
});

test('generate Base62 GUID', function () {
    $guid = TGuid::base62Guid();
    expect($guid)
        ->toBeString()
        ->and(strlen($guid))->toBe(24)
        ->and(preg_match('/^[0-9A-Za-z]{24}$/', $guid))->toBe(1);

    $guidWithDash = TGuid::base62Guid(true);
    expect($guidWithDash)
        ->toBeString()
        ->and(strlen($guidWithDash))->toBe(28)
        ->and(preg_match('/^[0-9A-Za-z\-]{28}$/', $guidWithDash))->toBe(1);
});

test('generate unpadded Base62 TGUID', function () {
    $tguid = TGuid::base62TGuid();
    expect($tguid)
        ->toBeString()
        ->and(strlen($tguid))->toBe(42)
        ->and(preg_match('/^[0-9A-Za-z]{42}$/', $tguid))->toBe(1);

    $tguidWithDash = TGuid::base62TGuid(true);
    expect($tguidWithDash)
        ->toBeString()
        ->and(strlen($tguidWithDash))->toBe(48)
        ->and(preg_match('/^[0-9A-Za-z\-]{48}$/', $tguidWithDash))->toBe(1);
});

test('convert TGUID to datetime', function (string $tGuid, string $datetime) {
    expect(TGuid::tGuidToTime($tGuid))->toBe($datetime);
})->with([
    ['29M1tfTJB2', '2024-12-29 18:39:16.000000'],
    ['29M1tfTpIG', '2024-12-29 18:39:16.123456'],
    ['29M1tfUICN', '2024-12-29 18:39:16.234567'],
]);

test('convert datetime to TGUID', function (string $datetime, ?string $tGuid) {
    expect(TGuid::timeToTGuid($datetime))->toBe($tGuid);
})->with([
    ['2024-12-29 18:39:16.000000', '29M1tfTJB2'],
    ['2024-12-29 18:39:16.123456', '29M1tfTpIG'],
    ['2024-12-29 18:39:16.234567', '29M1tfUICN'],
    ['2024-12-30 00:00:00.0000000', null],
]);
