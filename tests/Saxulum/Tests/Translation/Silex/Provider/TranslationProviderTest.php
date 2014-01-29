<?php

namespace Saxulum\Tests\Translation\Silex\Provider;

use Saxulum\Translation\Silex\Provider\TranslationProvider;
use Silex\Application;
use Silex\Provider\TranslationServiceProvider;

class TranslationProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testTranslations()
    {
        $app = new Application();
        $app['debug'] = true;
        $app['locale'] = 'en';

        $app->register(new TranslationServiceProvider());
        $app->register(new TranslationProvider(), array(
            'translation_cache' => __DIR__ . '/../../../../../../cache'
        ));

        $app['translation_paths'] = $app->share($app->extend('translation_paths', function ($paths) {
            $paths[] = __DIR__ . '/../../../../../data/';

            return $paths;
        }));

        $this->assertEquals('messages', $app['translator']->trans('value', array(), 'messages'));
        $this->assertEquals('Forms', $app['translator']->trans('value', array(), 'Forms'));
    }
}
