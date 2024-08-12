<?php

declare(strict_types=1);

// bootstrap.php
require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = ['src/'];
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'database',
    'port'     => '3306',
    'user'     => 'root',
    'password' => 'dbpass123',
    'dbname'   => 'async_listeners',
];

Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
Type::addType('uuid_binary', 'Ramsey\Uuid\Doctrine\UuidBinaryType');

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('uuid_binary', 'binary');
