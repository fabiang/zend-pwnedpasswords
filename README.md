# fabiang/zend-pwnedpasswords

Validator for the Zend Framework for [pwnedpasswords.com API](https://haveibeenpwned.com/API/v2#PwnedPasswords).

[![Latest Stable Version](https://poser.pugx.org/fabiang/zend-pwnedpasswords/version)](https://packagist.org/packages/fabiang/zend-pwnedpasswords)
[![License](https://poser.pugx.org/fabiang/zend-pwnedpasswords/license)](https://packagist.org/packages/fabiang/zend-pwnedpasswords)

## Installation

New to Composer? Read the [introduction](https://getcomposer.org/doc/00-intro.md#introduction). Run the following Composer command:

```console
$ composer require fabiang/zend-pwnedpasswords
```

## Use together with Zend-MVC

If you're using the component installer you should be asked where this module should be added.
If not add this to your `application.config.php`:

```php
<?php

return [
    'modules' => [
        // ...
        'Fabiang\ZendPwnedpasswords',
    ],
];
```

You then can use the validator in your forms, either by its FQCN or by its name 'pwnedpasswords'.

### Options

You can pass some options to the validator:

* returnOnError: should the validator return true/false on a transfer error
* logger: you can pass a PSR-3 logger to log all transfer errors
* logLevel: any PSR-3 log level, which is used as log level when errors are logged

## Licence

BSD-2-Clause. See the [LICENSE.md](LICENSE.md).
