#!/usr/bin/env php
<?php

use App\Console\Command\CacheClearCommand;
use Framework\Console\Input;
use Framework\Console\Output;
use Psr\Container\ContainerInterface;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var ContainerInterface $container
 */
$container = require 'config/container.php';

$commands = [
    $container->get(CacheClearCommand::class)
];

$input = new Input($argv);
$output = new Output();
$name = $input->getArgument(0);

if (!empty($name)){
    foreach ($commands as $definition){
        if ($definition['name'] == $name){
            $command = $container->get($definition['command']);
            $command->execute($input, $output);
            exit();
        }
    }

    throw new InvalidArgumentException('Undefined command ' . $name);
}

$output->writeln('<comment>Available command:</comment>');
$output->writeln('');

foreach ($commands as $command){
    $output->writeln('<info>' . $command->getName() .'</info>' . '\t' . $command->getDescription());
}
$output->writeln('');