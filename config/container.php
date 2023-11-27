<?php

use Zend\ServiceManager\ServiceManager;

$config = require __DIR__ . '/config.php';

$container = new ServiceManager($config['dependencies']);

$container->setService('config', $config);

return $container;

//
//use Framework\Container\Container;
//
//$container = new Container();
//
//$container->set('config', require __DIR__ . '/parameters.php');
////$container->set('db', new \PDO('mysql:host=localhost;dbname=dbname', 'username', 'password'));
//
//require __DIR__ . '/dependencies.php';
//
//return $container;