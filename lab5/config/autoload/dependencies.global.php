<?php

declare(strict_types=1);

use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationConfigInjectionDelegator;

return [
    'dependencies' => [
        'aliases' => [
        ],
        'invokables' => [
        ],
        'factories'  => [
        ],
        'delegators' => [
            Application::class => [
                ApplicationConfigInjectionDelegator::class,
            ],
        ],
    ],
];
