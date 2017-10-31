# mail-renderer

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Email Templating and Rendering Module for Phwoolcon

## Usage

### Configure

The [default config file]() will be linked to `app/config/mail-renderer.php`

If you need to change the options, please make a copy under production dir and modify it:
```bash
cp app/config/mail-renderer.php app/config/production/mail-renderer.php
vim app/config/production/mail-renderer.php
```

### Create Your Own Email Templates
```bash
vim phwoolcon-package/views/email/hello/world.phtml
```
```php
<?php
/* @var Phwoolcon\View\Engine\Php $this */
MailRenderer::setSubject(__('Hello world'));
?>
<h1>Hello <?= $name ?></h1>
<p>Welcome to use <code>phwoolcon/mail-renderer</code>!</p>
```

### Render Email From Template
```php
<?php
use MailRenderer;

list($subject, $body) = MailRenderer::renderEmail('hello/world', ['name' => 'John']);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email fishdrowned@gmail.com instead of using the issue tracker.

## Credits

- [Christopher CHEN][link-author]
- [All Contributors][link-contributors]

## License

The Apache License, Version 2.0. Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/phwoolcon/mail-renderer.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/phwoolcon/mail-renderer/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/phwoolcon/mail-renderer.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/phwoolcon/mail-renderer.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/phwoolcon/mail-renderer.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/phwoolcon/mail-renderer
[link-travis]: https://travis-ci.org/phwoolcon/mail-renderer
[link-scrutinizer]: https://scrutinizer-ci.com/g/phwoolcon/mail-renderer/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/phwoolcon/mail-renderer
[link-downloads]: https://packagist.org/packages/phwoolcon/mail-renderer
[link-author]: https://github.com/Fishdrowned
[link-contributors]: ../../contributors
