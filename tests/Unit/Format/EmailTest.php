<?php

use Wujidadi\Pangtshiu\Format\Email;

it('is a legal email address', function (string $email, bool $match) {
    expect(Email::match($email))->toBe($match);
})->with([
    ['example@example.com', true],
    ['invalid@.com', false],
    ['example@.', false],
    ['@example.com', false],
    ['example@.com', false],
    ['example.com', false],
    ['1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890@example.com', false],
    ['example@example..com', false],
    ['example@example.com.', false],
    ['example@example.com..', false],
    ['legal-email@example.com', true],
    ['legal-email@example.co.uk', true],
    ['legal-email@example.co.uk..', false],
    ['email@example.com', true],
]);
