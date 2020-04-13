<?php

namespace App\Service\Cart\Infrastructure;

use App\Service\Cart\Infrastructure\Factory\CardGatewayFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'invokables' => [
                    CardGatewayFactory::class,
                ],
            ],
        ];
    }
}
