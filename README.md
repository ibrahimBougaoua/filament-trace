# Filament Trace

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibrahimbougaoua/filament-trace.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-trace)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ibrahimbougaoua/filament-trace/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ibrahimbougaoua/filament-trace/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ibrahimbougaoua/filament-trace/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ibrahimbougaoua/filament-trace/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibrahimbougaoua/filament-trace.svg?style=flat-square)](https://packagist.org/packages/ibrahimbougaoua/filament-trace)

A Filament package is a reusable software library for PHP that provides logging and tracking functionality for CRUD operations and user interactions. It includes a logging class to capture create, read, update, delete actions, as well as user interactions like login and logout.

## Installation

You can install the package via composer:

```bash
composer require ibrahimbougaoua/filament-trace
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-trace-migrations"
php artisan migrate
```

Installation with:

```bash
php artisan filament-trace-install
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-trace-config"
```

You can Truncate the trace or logger with :

```bash
php artisan filament-logger-truncate
php artisan filament-trace-truncate
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-trace-views"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ibrahim](https://github.com/ibrahimBougaoua)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
