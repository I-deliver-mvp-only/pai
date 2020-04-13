<?php

namespace App\Service\DBAL\Infrastructure\Factory;

use Doctrine\DBAL\DriverManager;
use Psr\Container\ContainerInterface;

class DBALConnectionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return DriverManager::getConnection($container->get('config')['db']);
    }
}
