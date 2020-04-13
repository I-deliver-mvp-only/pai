<?php

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Zend\ServiceManager\ServiceManager;

/** @var ServiceManager $serviceManager */
$serviceManager = require 'container.php';

$connection = $serviceManager->get(Connection::class);

return new HelperSet([
    'db' => new ConnectionHelper($connection),
]);
