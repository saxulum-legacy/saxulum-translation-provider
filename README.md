saxulum-translation-provider
============================

**works with plain silex-php**

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-translation-provider.png?branch=master)](https://travis-ci.org/saxulum/saxulum-translation-provider)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-translation-provider/downloads.png)](https://packagist.org/packages/saxulum/saxulum-translation-provider)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-translation-provider/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-translation-provider)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-translation-provider/badges/quality-score.png?s=4529e17d24e0d36aa71782cf39b37e56dd423a8b)](https://scrutinizer-ci.com/g/saxulum/saxulum-translation-provider/)

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

#### Preparation (for non silex users)

##### Debug value is needed

```{.php}
$container['debug'] = true; // or false
```

##### Define translator service

```{.php}
use Symfony\Component\Translation\Translator;

$container['translator'] = function () {
    return new Translator('en');
};
```

Or if you load silex/silex as a dependency you can also use the TranslationServiceProvider.

```{.php}
use Silex\Provider\TranslationServiceProvider;

$container['locale'] = 'en';
$container->register(new TranslationServiceProvider());
```

#### For all users

##### With translation cache (faster)

```{.php}
use Saxulum\Translation\Silex\Provider\TranslationProvider;

$container->register(new TranslationProvider(), array(
    'translation_cache' => '/path/to/cache'
));
```

* `debug == true`: the cache file will be build at each load
* `debug == false`: the cache file will be build if not exists, delete it if its out of sync

##### Without translation cache (slower)

```{.php}
use Saxulum\Translation\Silex\Provider\TranslationProvider;

$container->register(new TranslationProvider());
```


Usage
-----

#### Add the translation paths

```{.php}
$container['translation_paths'] = $container->extend('translation_paths', function ($paths) {
    $paths[] = '/path/to/the/translations';

    return $paths;
});
```

Usage with Twig templates
-------------------------

To get access to the `|trans` filter in Twig templates, you must
register the translator first and then add the TwigServiceProvider from
`silex/silex`. You will also have to require the `symfony/twig-bridge` package.

```{.php}
use Silex\Provider\TwigServiceProvider;

$this->register(new TwigServiceProvider(), [
    'twig.path'    => array(__DIR__.'/../views'),
    'twig.options' => array('cache' => $cacheDir),
]);
```

[1]: https://packagist.org/packages/saxulum/saxulum-translation-provider
