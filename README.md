# A Filament Panel Setting

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rupadana/filament-panel-setting.svg?style=flat-square)](https://packagist.org/packages/rupadana/filament-panel-setting)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/rupadana/filament-panel-setting/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rupadana/filament-panel-setting/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rupadana/filament-panel-setting.svg?style=flat-square)](https://packagist.org/packages/rupadana/filament-panel-setting)



A package that can setting your panel without coding.

## Installation

You can install the package via composer:

```bash
composer require rupadana/filament-panel-setting
```


## Publish config

```bash
php artisan vendor:publish --tag=filament-panel-setting-config
```

```php
return [
    'page' => [
        'theme' => true,
        'setting' => true,
    ],
    'can_access' => [
        'role' => ['super_admin']
    ]
];
```

## Usage

Register `FilamentPanelSettingPlugin` it to your panel.

```php

use Rupadana\FilamentPanelSetting\FilamentPanelSettingPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
            ->plugins([
                FilamentPanelSettingPlugin::make(),
            ])
}
```


The data will be saved at storage as a json file.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rupadana](https://github.com/rupadana)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
