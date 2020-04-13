<?php

namespace App\Service\DBAL\Infrastructure;

use App\Service\DBAL\Infrastructure\Factory\DBALConnectionFactory;
use Doctrine\DBAL\Connection;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'aliases' => [
                    'DBALConnection' => Connection::class,
                ],
                'factories' => [
                    Connection::class => DBALConnectionFactory::class,
                ],
            ],
        ];
    }
}
