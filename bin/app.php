#!/usr/bin/env php
<?php

use App\Console\Command\CacheClearCommand;
use Psr\Container\ContainerInterface;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var ContainerInterface $container
 */
$container = require 'config/container.php';

//$command = $container->get(CacheClearCommand::class);
//$command->execute($argv);
echo "<pre>";
print_r('ok');
echo "</pre>";
die();