# "Pang-tshiú" Helper Library

[![zread](https://img.shields.io/badge/Ask_Zread-_.svg?style=plastic&color=00b0aa&labelColor=000000&logo=data%3Aimage%2Fsvg%2Bxml%3Bbase64%2CPHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTQuOTYxNTYgMS42MDAxSDIuMjQxNTZDMS44ODgxIDEuNjAwMSAxLjYwMTU2IDEuODg2NjQgMS42MDE1NiAyLjI0MDFWNC45NjAxQzEuNjAxNTYgNS4zMTM1NiAxLjg4ODEgNS42MDAxIDIuMjQxNTYgNS42MDAxSDQuOTYxNTZDNS4zMTUwMiA1LjYwMDEgNS42MDE1NiA1LjMxMzU2IDUuNjAxNTYgNC45NjAxVjIuMjQwMUM1LjYwMTU2IDEuODg2NjQgNS4zMTUwMiAxLjYwMDEgNC45NjE1NiAxLjYwMDFaIiBmaWxsPSIjZmZmIi8%2BCjxwYXRoIGQ9Ik00Ljk2MTU2IDEwLjM5OTlIMi4yNDE1NkMxLjg4ODEgMTAuMzk5OSAxLjYwMTU2IDEwLjY4NjQgMS42MDE1NiAxMS4wMzk5VjEzLjc1OTlDMS42MDE1NiAxNC4xMTM0IDEuODg4MSAxNC4zOTk5IDIuMjQxNTYgMTQuMzk5OUg0Ljk2MTU2QzUuMzE1MDIgMTQuMzk5OSA1LjYwMTU2IDE0LjExMzQgNS42MDE1NiAxMy43NTk5VjExLjAzOTlDNS42MDE1NiAxMC42ODY0IDUuMzE1MDIgMTAuMzk5OSA0Ljk2MTU2IDEwLjM5OTlaIiBmaWxsPSIjZmZmIi8%2BCjxwYXRoIGQ9Ik0xMy43NTg0IDEuNjAwMUgxMS4wMzg0QzEwLjY4NSAxLjYwMDEgMTAuMzk4NCAxLjg4NjY0IDEwLjM5ODQgMi4yNDAxVjQuOTYwMUMxMC4zOTg0IDUuMzEzNTYgMTAuNjg1IDUuNjAwMSAxMS4wMzg0IDUuNjAwMUgxMy43NTg0QzE0LjExMTkgNS42MDAxIDE0LjM5ODQgNS4zMTM1NiAxNC4zOTg0IDQuOTYwMVYyLjI0MDFDMTQuMzk4NCAxLjg4NjY0IDE0LjExMTkgMS42MDAxIDEzLjc1ODQgMS42MDAxWiIgZmlsbD0iI2ZmZiIvPgo8cGF0aCBkPSJNNCAxMkwxMiA0TDQgMTJaIiBmaWxsPSIjZmZmIi8%2BCjxwYXRoIGQ9Ik00IDEyTDEyIDQiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLXdpZHRoPSIxLjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8L3N2Zz4K&logoColor=ffffff)](https://zread.ai/Wujidadi/PangTshiu)

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

### Json: handling JSON data

#### Json::unescape

Encode a given data into JSON format with special characters and slashes unescaped.

#### Json::prettyPrint

Pretty print a given data into JSON format with special characters and slashes unescaped.

### PrivateKey: handling key pairs of private and public keys

#### PrivateKey::generate

Generates a key pair of private and public keys.

### TGuid: Utility Class for handling TGUID (Time-sequential GUID)

#### TGuid::create

Generate a Base62 TGUID with additional padding to meet 42 characters.  
42, the Answer to the Ultimate Question of Life, The Universe, and Everything!

#### TGuid::uuid

Generate a UUID by combining uniqid and a standard GUID.

#### TGuid::base62Guid

Generate a GUID in Base62 encoding.

#### TGuid::base62TGuid

Generate a TGUID in Base62 encoding.

#### TGuid::tGuidToTime

Convert a Base62 TGUID to a UTC datetime.

#### TGuid::timeToTGuid

Convert a datetime string into a Base62 number string just like the first 10 characters of a TGUID.
