<?php

namespace Wujidadi\Pangtshiu\PrivateKey;

/**
 * Data transfer object storing a key pair of private and public keys.
 */
class KeyPair
{
    public function __construct(
        /**
         * @param string $private private key
         */
        public string $private,
        /**
         * @param string $private public key
         */
        public string $public
    ) {}
}
