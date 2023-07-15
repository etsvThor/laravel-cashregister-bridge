# Connect a laravel application with the Thor cash register

[![Latest Version on Packagist](https://img.shields.io/packagist/v/etsvthor/laravel-cashregister-bridge.svg?style=flat-square)](https://packagist.org/packages/etsvthor/laravel-cashregister-bridge)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/etsvthor/laravel-cashregister-bridge/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/etsvthor/laravel-cashregister-bridge/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/etsvthor/laravel-cashregister-bridge/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/etsvthor/laravel-cashregister-bridge/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/etsvthor/laravel-cashregister-bridge.svg?style=flat-square)](https://packagist.org/packages/etsvthor/laravel-cashregister-bridge)

This package allows paying items from the website with the Thor cash register, for instance activity subscriptions from the Thorsite or TesLAN tickets. If an item is paid on the website, it's synced to the cash register. An item that is paid on the cash register gets synced to the external website as well.

## Installation

You can install the package via composer:

```bash
composer require etsvthor/laravel-cashregister-bridge
```

Optionally, you can publish the config file. This is not necessary normally, but you can do it with:

```bash
php artisan vendor:publish --tag="cashregister-bridge-config"
```

This is the contents of the published config file:

```php
return [
    'service_id' => env('CASHREGISTER_SERVICE_ID'),
    'secret' => env('CASHREGISTER_SECRET'),
    'base_url' => env('CASHREGISTER_BASE_URL', 'https://kassa.thor.edu`'),
];
```

Create a service via `https://finances.thor.edu/admin/services` and put the service id + secret in the `.env`.

## Usage
There are 2 types of models that needs to have an interface implemented. See the thorsite as example. 

### External Product
A product that you can sell. This can be an activity or a merch item to sell, etc.
(For the thorsite: webform)
- Implement the `EtsvThor\CashRegisterBridge\Contracts\HasExternalProduct` interface
- Use the `EtsvThor\CashRegisterBridge\Traits\PushesExternalProduct` trait

This will make you implement a conversion from the model to the linked DTO

### External Product Item
The model that keeps track of what you sold. E.g. an activity subscription or someone who buys a merch item.
(For the thorsite: webform submission)
- Implement the `EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem` interface
- Use the `EtsvThor\CashRegisterBridge\Traits\PushesExternalProduct` trait

This will make you implement a conversion from the model to the linked DTO

## Migration
If you have existing models in your database with the `HasExternalProduct` and `HasExternalProductItem` interface, then you need to `touch` them, so they get put on the cash register E.g.
```php
foreach(Webform::all() as $webform){
    $webform->touch();
}

foreach(WebformSubmission::all() as $webform_submission){
    $webform_submission->touch();
}
```
You may need to throttle this, to not send too many http requests

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Niek Brekelmans](https://github.com/niekbr)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
