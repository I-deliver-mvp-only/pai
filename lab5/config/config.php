<?php

declare(strict_types=1);

use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator([
    \Zend\Expressive\Session\Ext\ConfigProvider::class,
    \Zend\Expressive\Session\ConfigProvider::class,
    \Zend\HttpHandlerRunner\ConfigProvider::class,
    \Zend\Expressive\Twig\ConfigProvider::class,
    \Zend\Expressive\Router\FastRouteRouter\ConfigProvider::class,

    \Zend\Expressive\Helper\ConfigProvider::class,
    \Zend\Expressive\ConfigProvider::class,
    \Zend\Expressive\Router\ConfigProvider::class,

    App\View\ConfigProvider::class,
    App\API\ConfigProvider::class,
    App\Service\Cart\Infrastructure\ConfigProvider::class,
    App\Service\DBAL\Infrastructure\ConfigProvider::class,
    App\Service\Product\Infrastructure\ConfigProvider::class,
    App\Service\Payment\Infrastructure\ConfigProvider::class,

    // Load application config in a pre-defined order in such a way that local settings
    // overwrite global settings. (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new PhpFileProvider(realpath(__DIR__) . '/{{,*.}global,{,*.}local}.php'),
    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),

    // Load development config if it exists
    new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
]);

return $aggregator->getMergedConfig();
