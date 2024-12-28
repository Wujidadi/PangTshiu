<?php

use Wujidadi\Pangtshiu\Base62;

it('generate random base62 strings', function () {
    $num1 = Base62::string();
    $num2 = Base62::string(12);
    $num3 = Base62::string(18);
    $num4 = Base62::string(30);
    expect($num1)->toHaveLength(8)
        ->and($num2)->toHaveLength(12)
        ->and($num3)->toHaveLength(18)
        ->and($num4)->toHaveLength(30);
});

it('convert base10 to base62', function () {
    $decNum = 12345678;
    $base62Num = Base62::decToBase62($decNum);
    expect($base62Num)->toBe('pnfq');
});

it('convert base62 to base10', function () {
    $base62Num = 'pnfq';
    $decNum = Base62::base62ToDec($base62Num);
    expect($decNum)->toEqual(12345678);
});

it('convert base62 to base10 with invalid characters', function () {
    $base62Num = 'pnfq!';
    Base62::base62ToDec($base62Num);
})->throws(InvalidArgumentException::class, 'Invalid character in Base62 string: !');
