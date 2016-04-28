<?php

namespace Saxulum\Translation\Provider;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

class TranslationProvider
{
    public function register(\Pimple $container)
    {
        $container['translation_cache'] = null;

        $container['translation_paths'] = $container->share(function () {
            $paths = array();

            return $paths;
        });

        $container['translator'] = $container->share($container->extend('translator',
            function (Translator $translator) use ($container) {

                if (!is_null($container['translation_cache'])) {
                    if (!is_null($container['translation_cache']) && !is_dir($container['translation_cache'])) {
                        mkdir($container['translation_cache'], 0777, true);
                    }

                    $cacheFile = $container['translation_cache'] . '/saxulum-translation.php';
                    if ($container['debug'] || !file_exists($cacheFile)) {
                        $translationMap = $container['translation_search']();
                        file_put_contents(
                            $cacheFile,
                            '<?php return ' . var_export($translationMap, true) . ';'
                        );
                    } else {
                        $translationMap = require $cacheFile;
                    }
                } else {
                    $translationMap = $container['translation_search']();
                }

                $translator->addLoader('yaml', new YamlFileLoader());
                foreach ($translationMap as $translation) {
                    $translator->addResource('yaml', $translation['path'], $translation['locale'], $translation['domain']);
                }

                return $translator;
            }
        ));

        $container['translation_search'] = $container->protect(function () use ($container) {
            $translationMap = array();
            foreach ($container['translation_paths'] as $path) {
                foreach (Finder::create()->files()->name('*.yml')->in($path) as $file) {
                    /** @var SplFileInfo $file */
                    $domainAndLocale = explode('.', $file->getBasename('.yml'));
                    if (count($domainAndLocale) == 2) {
                        $translationMap[] = array(
                            'path' => $file->getPathname(),
                            'locale' => $domainAndLocale[1],
                            'domain' => $domainAndLocale[0]
                        );
                    }
                }
            }

            return $translationMap;
        });
    }
}
