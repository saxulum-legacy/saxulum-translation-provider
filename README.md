saxulum-translation-provider
============================

**works with plain silex-php**

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-translation-provider.png?branch=master)](https://travis-ci.org/saxulum/saxulum-translation-provider)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-translation-provider/downloads.png)](https://packagist.org/packages/saxulum/saxulum-translation-provider)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-translation-provider/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-translation-provider)

Features
--------

* Register translations

Requirements
------------

* php >=5.3
* Symfony Config Component >=2.3
* Symfony Finder Component >=2.3
* Symfony Translation Component >=2.3
* Symfony Yaml Component >=2.3

Installation
------------

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-translation-provider][1].

### With translation cache (faster)

```{.php}
use Saxulum\Translation\Silex\Provider\TranslationProvider;
use Silex\Provider\TranslationServiceProvider;

$app->register(new TranslationServiceProvider());
$app->register(new TranslationProvider(), array(
    'translation_cache' => '/path/to/cache'
));
```

* `debug == true`: the cache file will be build at each load
* `debug == false`: the cache file will be build if not exists, delete it if its out of sync

### Without translation cache (slower)

```{.php}
use Saxulum\Translation\Silex\Provider\TranslationProvider;
use Silex\Provider\TranslationServiceProvider;

$app->register(new TranslationServiceProvider());
$app->register(new TranslationProvider());
```
Usage
-----

### Add the translation paths

```{.php}
$app['translation_paths'] = $app->share($app->extend('translation_paths', function ($paths) {
    $paths[] = '/path/to/the/translations';

    return $paths;
}));
```

[1]: https://packagist.org/packages/saxulum/saxulum-translation-provider