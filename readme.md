# ApiClient

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]


Client for the  REST API at [developers portal](http://developers.iaip.iw.sv/docs) of IAIP.

**Note:** This package is **under development** and **should not be used in production sites**, until version **1.0.0 or above** is released.

## Installation

Via Composer

``` bash
$ composer require iaipes/apiclient
```


### Configuration

#### Laravel

Publish configuration

```bash
php artisan vendor:publish --provider aipes\ApiClient\ApiClientServiceProvider
```

Configure the next variables in you `.env` file:

```bash
IAIPES_API_TOKEN={token}
IAIPES_API_URL=http://developers.iaip.iw.sv
IAIPES_API_TIMEOUT=10
```

**Note:** replace `{token}` with your developer access token.

## Usage

### PHP 

```php
use Iaipes\ApiClient\Http\Client\Api\V1\InformationRequestClient;
$client = new InformationRequestClient;
$response = $client->index([
        'include' => 'institution',
        'filter' => [
            'profession_cont' => 'Desarrollador'
        ],
        'sort' => 'created_at desc'
    ]);
```

**Note:** For more information about classes and methods, please check the [documentation](http://developers.iaip.iw.sv/docs)

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [IAIP][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/iaipes/apiclient.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/iaipes/apiclient.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/iaipes/apiclient/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/iaipes/apiclient
[link-downloads]: https://packagist.org/packages/iaipes/apiclient
[link-travis]: https://travis-ci.org/iaipes/apiclient
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/iaipes
[link-contributors]: ./contributors.md