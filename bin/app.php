#!/usr/bin/env php
<?php

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

foreach ($commands as $command){
    $cli->add($container->get($command));
}

$cli->run();