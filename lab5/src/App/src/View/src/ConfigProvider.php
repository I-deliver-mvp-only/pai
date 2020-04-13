<?php

declare(strict_types=1);

namespace App\View;

use App\View\Handler\CartPageHandler;
use App\View\Handler\HomePageHandler;
use Blast\ReflectionFactory\ReflectionFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'routes' => $this->getRoutes(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                HomePageHandler::class => ReflectionFactory::class,
                CartPageHandler::class => ReflectionFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../../../templates/app'],
                'error' => [__DIR__ . '/../../../templates/error'],
                'layout' => [__DIR__ . '/../../../templates/layout'],
            ],
        ];
    }

    /**
     * Returns routes of defined endpoints
     */
    private function getRoutes(): array
    {
        return [
            [
                'name' => 'home',
                'path' => '/',
                'middleware' => HomePageHandler::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'name' => 'cart',
                'path' => '/cart',
                'middleware' => CartPageHandler::class,
                'allowed_methods' => ['GET'],
            ],
        ];
    }
}
