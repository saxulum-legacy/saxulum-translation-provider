<?php

namespace Saxulum\Tests\Translation\Silex\Provider;

use Pimple\Container;
use Saxulum\Translation\Provider\TranslationProvider;
use Symfony\Component\Translation\Translator;

class TranslationProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testWithCache()
    {
        $container = new Container();
        $container['debug'] = true;

        $container['translator'] = function () {
            return new Translator('en');
        };

        $container->register(new TranslationProvider(), array(
            'translation_cache' => __DIR__ . '/../../../../../cache'
        ));

        $container['translation_paths'] = $container->extend('translation_paths', function ($paths) {
            $paths[] = __DIR__ . '/../../../../data/';

            return $paths;
        });

        $this->assertEquals('messages', $container['translator']->trans('value', array(), 'messages'));
        $this->assertEquals('Forms', $container['translator']->trans('value', array(), 'Forms'));
    }

    public function testWithoutCache()
    {
        $container = new Container();
        $container['debug'] = true;

        $container['translator'] = function () {
            return new Translator('en');
        };

        $container->register(new TranslationProvider(), array(
            'translation_cache' => __DIR__ . '/../../../../../cache'
        ));

        $container['translation_paths'] = $container->extend('translation_paths', function ($paths) {
            $paths[] = __DIR__ . '/../../../../data/';

            return $paths;
        });

        $this->assertEquals('messages', $container['translator']->trans('value', array(), 'messages'));
        $this->assertEquals('Forms', $container['translator']->trans('value', array(), 'Forms'));
    }
}
