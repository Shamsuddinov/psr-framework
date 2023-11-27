<?php

use App\Http\Action;

/**
 * @var \Framework\Http\Application $app
 */

$app->get('home', '/', Action\HomeAction::class);
$app->get('about', '/about', Action\AboutAction::class);
//$app->get('cabinet', '/cabinet', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
//$app->get('post', '/post', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
//$app->get('blog', '/blog', new Action\BasicAuthActionDecorator(new Action\Blog\IndexAction, $params['users'] ?? []));
//$app->get('blog_show', '/blog/{id}', new Action\BasicAuthActionDecorator(new Action\Blog\ShowAction, $params['users'] ?? []))->tokens(['id' => '\d+']);