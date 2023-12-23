#!/usr/bin/env php
<?php

use Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var ContainerInterface $container
 */
$container = require 'config/container.php';

$cli = new Application();
$commands = $container->get('config')['console']['commands'];

$entityManager = $container->get(EntityManagerInterface::class);
$connection = $entityManager->getConnection();

$configuration = new Doctrine\DBAL\Migrations\Configuration\Configuration($connection);
$configuration->setMigrationsDirectory('db/migrations');
$configuration->setMigrationsNamespace('Migration');

$cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');
$cli->getHelperSet()->set(new ConfigurationHelper($connection, $configuration), 'configuration');

Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);

foreach ($commands as $command){
    $cli->add($container->get($command));
}

$cli->run();