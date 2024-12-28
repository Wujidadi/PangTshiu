<?php

use Wujidadi\Pangtshiu\Base64;
use Wujidadi\Pangtshiu\Cipher;
use Wujidadi\Pangtshiu\PrivateKey;

test('encrypt a string with a public key, encode it to base64, finally decrypt it back with a private key', function (string $string) {
    $keyPair = PrivateKey::generate();
    $privateKey = $keyPair->private;
    $publicKey = $keyPair->public;

    $encryptedData = Cipher::publicEncrypt($string, $publicKey);
    $base64EncodedData = Base64::urlSafeEncode($encryptedData);

    $encryptedDataRevert = Base64::urlSafeDecode($base64EncodedData);
    $stringRevert = Cipher::privateDecrypt($encryptedDataRevert, $privateKey);

    expect($stringRevert)->toBe($string);
})->with([
    ['哥們，不是，你疑似有點大病了'],
    ['车万厨自重'],
    ['然後由於我這個閱讀速度過於快，當我意識到我讀到了什麼內容的時候，一切都已經來不及了'],
]);
