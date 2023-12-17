#!/usr/bin/env php
<?php

use App\Console\Command\CacheClearCommand;
use Framework\Console\Input;
use Psr\Container\ContainerInterface;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var ContainerInterface $container
 */
$container = require 'config/container.php';

$command = $container->get(CacheClearCommand::class);
$args = array_slice($argv, 1);

$input = new Input($args);

$command->execute($input);
echo "<pre>";
print_r('ok');
echo "</pre>";
die();