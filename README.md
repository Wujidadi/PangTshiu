# "Pang-tshiú" Helper Library

A simple library of set of PHP helper methods, constants and classes.

## The "Pang-tshiú"s

### Base62

Utility class handling Base62 numbers.

#### Base62::string

Generates a random Base62 string with variable length controlled by the parameter.

#### Base62::decToBase62

Converts a decimal number to a Base62 number string.

#### Base62::Base62ToDec

Converts a Base62 number string to a decimal number string.

### Base64

Utility class built on PHP's base64 functions, adding features and encapsulation.

#### Base64::urlSafeEncode

Encodes the input string to a URL-safe Base64 format.

#### Base64::urlSafeDecode

Decodes a URL-safe Base64 string back to its original value.

### Cipher

Utility class that standardizes OpenSSL functions for consistency.

#### Cipher::publicEncrypt

Encrypts the input string using a public key.

#### Cipher::privateDecrypt

Decrypts the input string using a private key.

### PrivateKey

Utility class for handling key pairs of private and public keys.

#### PrivateKey::generate

Generates a key pair of private and public keys.

## About `pint.json`

This library doesn't rely on Laravel. This file here is included only for documentation and tracking purposes.
