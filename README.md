# "Pang-tshiú" Helper Library

A simple library containing a set of PHP helper methods, constants, and classes.

## Setup and Command-Line Testing for Local Development

```shell
composer i
cp .rc.example .rc
cp .test.example .test
source .rc
```

Now, you can type devt in the terminal to run a simple local command-line test with Symfony-style output:
```shell
true # the result of Date::isLeapYear(2024);
```

## The "Pang-tshiú"s

### Base62: handling Base62 numbers

#### Base62::string

Generates a random Base62 string with variable length controlled by the parameter.

#### Base62::decToBase62

Converts a decimal number to a Base62 number string.

#### Base62::Base62ToDec

Converts a Base62 number string to a decimal number string.

### Base64: built on PHP's base64 functions, adding features and encapsulation

#### Base64::urlSafeEncode

Encodes the input string to a URL-safe Base64 format.

#### Base64::urlSafeDecode

Decodes a URL-safe Base64 string back to its original value.

### Cipher: standardizes OpenSSL functions for consistency

#### Cipher::publicEncrypt

Encrypts the input string using a public key.

#### Cipher::privateDecrypt

Decrypts the input string using a private key.

### Date: validating and parsing date-time strings

#### Date::ymdhis

Validate a datetime string in 'Y-m-d H:i:s' format, including BCE years.

#### Date::isLeapYear

Determine if a year is a leap year.

#### Date::isLegalDate

Validate if a given date is legal.

#### Date::isLegalTime

Validate if a given time is legal.

### Email: handling email addresses

#### Email::match

Validate the validity of an email address (as closely as possible to [RFC 5322](https://datatracker.ietf.org/doc/html/rfc5322) and [RFC 6531](https://datatracker.ietf.org/doc/html/rfc6531) standards).

### Excel: handling Excel-related conversions

#### Excel::columnToNumber

Convert Excel column letters to a number.

#### Excel::numberToColumn

Convert a number to Excel column letters.

### Guid: generating GUIDs (Globally Unique Identifiers)

#### Guid::create

Generates a GUID.

#### Guid::isLegal

Checks if a given GUID is valid.

### PrivateKey: handling key pairs of private and public keys

#### PrivateKey::generate

Generates a key pair of private and public keys.
