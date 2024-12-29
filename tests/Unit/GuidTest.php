<?php

use Wujidadi\Pangtshiu\Guid;

test('create guid', function () {
    $guid = Guid::create();
    $compare = Guid::isLegal($guid);
    expect($guid)->toHaveLength(36)
        ->and($compare)->toBeTrue();
});
