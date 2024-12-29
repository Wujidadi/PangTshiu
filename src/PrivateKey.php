<?php

namespace Wujidadi\Pangtshiu;

use Wujidadi\Pangtshiu\PrivateKey\KeyPair;

/**
 * Utility class for handling key pairs of private and public keys.
 */
class PrivateKey
{
    /**
     * Generates a key pair of private and public keys.
     *
     * @param ?array $options additional options for generating the key pair. As same as in `openssl_pkey_new`
     * @return KeyPair a KeyPair object containing the generated private and public keys
     */
    public static function generate(?array $options = null): KeyPair
    {
        if (is_null($options)) {
            $options = [
                'private_key_bits' => 2048,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ];
        }
        $keyPair = openssl_pkey_new($options);
        openssl_pkey_export($keyPair, $privateKey);
        $publicKey = openssl_pkey_get_details($keyPair)['key'];

        return new KeyPair($privateKey, $publicKey);
    }
}
