<?php

namespace Saxulum\Translation\Cilex\Provider;

use Saxulum\Translation\Provider\TranslationProvider as BaseTranslationProvider;
use Cilex\Application;
use Cilex\ServiceProviderInterface;

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