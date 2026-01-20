# Bale View of Dindik Company Profile

[![Latest Version on Packagist](https://img.shields.io/packagist/v/paparee/bale-dindik.svg?style=flat-square)](https://packagist.org/packages/paparee/bale-dindik)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/paparee/bale-dindik/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/paparee/bale-dindik/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/paparee/bale-dindik/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/paparee/bale-dindik/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/paparee/bale-dindik.svg?style=flat-square)](https://packagist.org/packages/paparee/bale-dindik)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/bale-dindik.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/bale-dindik)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require paparee/bale-dindik
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="bale-dindik-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="bale-dindik-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="bale-dindik-views"
```

## Usage

### Asset Usage (CDN)

Seluruh asset gambar dan file statis di package ini disarankan menggunakan helper `cdn_asset()` yang disediakan oleh package `bale-emperan`.

#### Contoh di Blade

```blade
{{-- Logo Shared --}}
<img src="{{ cdn_asset('shared/logo-png.png') }}" alt="Logo">

{{-- Thumbnail Berita (Otomatis menggunakan organization slug) --}}
<img src="{{ cdn_asset('thumbnails/' . $post->thumbnail) }}" alt="{{ $post->title }}">

{{-- Asset Khusus Landing Page --}}
<img src="{{ cdn_asset('landing-page/' . $bg['path']) }}" alt="Background">
```

#### Keuntungan

- **Performa**: Aset dimuat dari CDN (misal: `cdn.ponorogo.go.id`).
- **Efisiensi**: Otomatis menangani path organisasi berdasarkan data di database.
- **Fallback**: Jika CDN dinonaktifkan, otomatis kembali ke path lokal.

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

- [Papa Ree](https://github.com/paparee)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
