<?php

namespace Saxulum\Translation\Silex\Provider;

use Saxulum\Translation\Provider\TranslationProvider as BaseTranslationProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;

class TranslationProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $translationProvider = new BaseTranslationProvider();
        $translationProvider->register($app);
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app) {}
}