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
     *
     * @param string $data the input string to encrypt
     * @param array|OpenSSLAsymmetricKey|OpenSSLCertificate|string $publicKey the public key to use for encryption
     * @param int $padding the padding mode to use for encryption
     * @return string the encrypted string
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
     *
     * @param string $data the input string to decrypt
     * @param array|OpenSSLAsymmetricKey|OpenSSLCertificate|string $privateKey the private key to use for decryption
     * @param int $padding the padding mode to use for decryption
     * @return string the decrypted string
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
