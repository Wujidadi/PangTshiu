<?php

namespace Wujidadi\Pangtshiu;

use OpenSSLAsymmetricKey;
use OpenSSLCertificate;

/**
 * Utility class that standardizes OpenSSL functions for consistency.
 */
class Cipher
{
    /**
     * Encrypts the input string using a public key.
     */
    public static function publicEncrypt(
        string $data,
        array|OpenSSLAsymmetricKey|OpenSSLCertificate|string $publicKey,
        int $padding = OPENSSL_PKCS1_PADDING
    ): string {
        openssl_public_encrypt($data, $encryptedData, $publicKey, $padding);
        return $encryptedData;
    }

    /**
     * Decrypts the input string using a private key.
     */
    public static function privateDecrypt(
        string $data,
        array|OpenSSLAsymmetricKey|OpenSSLCertificate|string $privateKey,
        int $padding = OPENSSL_PKCS1_PADDING
    ): string {
        openssl_private_decrypt($data, $decryptedData, $privateKey, $padding);
        return $decryptedData;
    }
}
