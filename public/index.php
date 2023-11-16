<?php

//use Framework\Http\RequestFactory;
//use Framework\Http\Response;


use App\Http\Action;
use App\Http\Middleware;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Pipeline\Pipeline;
use Framework\Http\Router\AuraRouterAdapter;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';
// 1-dars
//$request = ServerRequestFactory::fromGlobals();
//
//$name = $request->getQueryParams()['name'] ?? 'Guest';
//
//$response = (new HtmlResponse('Hello' . $name . '!'))
//    ->withHeader('X-Developer', 'Abbosxon');
//
//$emitter = new SapiEmitter();
//$emitter->emit($response);

//$emitter = new ResponseSender();
//$emitter->send($response);
//$request = RequestFactory::fromGlobals();
//
//$name = $request->getQueryParams()['name'] ?? 'Guest!';
//echo "Hello, " . $name . PHP_EOL;
//
//$response = (new Response('Hello, ' . $name . '!'))
//            ->withHeader('X-Developer', 'Abbosxon');
//
//header('HTTP/1.0 ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase());
//
//foreach ($response->getHeaders() as $name => $value){
//    header($name . ':' . $value);
//}

//$request = ServerRequestFactory::fromGlobals();
//
//$path = $request->getUri()->getPath();
//
//if ($path == '/'){
//    $name = $request->getQueryParams()['name'] ?? 'Guest';
//
//    $response = new HtmlResponse('Hello ' . $name . '!');
//} elseif($path == '/about'){
//    $response = new HtmlResponse('About page');
//} elseif ($path == '/blog'){
//    $response = new JsonResponse([
//        ['id' => 1, 'name' => 'Food']
//    ]);
//} elseif (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)){
//    echo "<pre>";
//    print_r($matches);
//    echo "</pre>";
//    die();
//}
//
//$response->withHeader('X-Developer', 'Abbosxon');
//
//$emitter = new SapiEmitter();
//$emitter->emit($response);

//2-dars

//$routes = new RouteCollection();
//
//$routes->get('Home', '/', function (ServerRequestInterface $request) {
//    $name = $request->getQueryParams()['name'] ?? 'Guest';
//    return new HtmlResponse('Hello ' . $name . '!');
//});
//
//$routes->get('About', '/about', function (ServerRequestInterface $request) {
//    return new HtmlResponse('About page');
//});
//
//$routes->get('Blog', '/blog', function (ServerRequestInterface $request) {
//    return new JsonResponse([
//        ['id' => 1, 'name' => 'Food']
//    ]);
//});
//
//$routes->get('Blog', '/blog/{id}', function (ServerRequestInterface $request) {
//    $id = $request->getAttribute('id');
//
//    return new JsonResponse([
//        ['id' => $id, 'name' => 'Food']
//    ]);
//}, ['id' => '\d+']);
//
//$router = new Router($routes);
//
//$request = ServerRequestFactory::fromGlobals();
//
//try {
//    $result = $router->match($request);
//
//    foreach ($request->getAttributes() as $attribute => $value){
//        $request = $request->withAttribute($attribute, $value);
//    }
//
//    $action = $result->getHandler();
//
//    $response = $action($request);
//
//} catch (Exception $exception){
//    $response = new JsonResponse(['error' => 'Undefined page']);
//}
//
//$response = $response->withHeader('X-Developer', 'Abbosxon');
//
//$emitter = new SapiEmitter();
//$emitter->emit($response);

//$params  = [
//    'users' => ['admin' => 'password']
//];
//
//$aura = new \Aura\Router\RouterContainer();
//
//$routes = $aura->getMap();
//
//$routes->get('home', '/', Action\HomeAction::class);
//$routes->get('about', '/about', Action\AboutAction::class);
//$routes->get('cabinet', '/cabinet', new Action\CabinetAction($params ['users']));
//$routes->get('blog', '/blog', Action\Blog\IndexAction::class);
//$routes->get('blog_show', '/blog/{id}', Action\Blog\ShowAction::class)->tokens(['id' => '\d+']);
//
//$router = new AuraRouterAdapter($aura);
//$resolver = new ActionResolver();
//
//$request = ServerRequestFactory::fromGlobals();
//
//try {
//    $result = $router->match($request);
//
//    foreach ($request->getAttributes() as $attribute => $value){
//        $request = $request->withAttribute($attribute, $value);
//    }
//
//    $action = $resolver->resolve($result->getHandler());
//    $response = $action($request);
//} catch (Exception $exception){
//    $response = new JsonResponse(['error' => 'Undefined page'], 404);
//}
//
//$response = $response->withHeader('X-Developer', 'Abbosxon');
//
//$emitter = new SapiEmitter();
//$emitter->emit($response);


//$params  = [
//    'users' => ['admin' => 'password']
//];
//
//$aura = new \Aura\Router\RouterContainer();
//
//$routes = $aura->getMap();
//
//$routes->get('home', '/', new Action\BasicAuthActionDecorator(new Action\HomeAction(), $params['users'] ?? []));
//$routes->get('about', '/about', new Action\BasicAuthActionDecorator(new Action\AboutAction(), $params['users'] ?? []));
////$routes->get('cabinet', '/cabinet', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
//
//$routes->get('cabinet', '/cabinet', function (ServerRequestInterface $request) use ($params){
//    $auth = new Middleware\BasicAuthMiddleware($params['users']);
//    $profiler = new Middleware\ProfilerMiddleware();
//    $cabinet = new Action\CabinetAction();
//
//    return $profiler($request, function (ServerRequestInterface  $request) use ($auth, $cabinet){
//        return $auth($request, function (ServerRequestInterface  $request) use ($cabinet) {
//            return $cabinet($request);
//        });
//    });
//});
//
//$routes->get('blog', '/blog', new Action\BasicAuthActionDecorator(new Action\Blog\IndexAction, $params['users'] ?? []));
//$routes->get('blog_show', '/blog/{id}', new Action\BasicAuthActionDecorator(new Action\Blog\ShowAction, $params['users'] ?? []))->tokens(['id' => '\d+']);
//
//$router = new AuraRouterAdapter($aura);
//$resolver = new ActionResolver();
//
//$request = ServerRequestFactory::fromGlobals();
//
//try {
//    $result = $router->match($request);
//
//    foreach ($request->getAttributes() as $attribute => $value){
//        $request = $request->withAttribute($attribute, $value);
//    }
//
//    $action = $resolver->resolve($result->getHandler());
//    $response = $action($request);
//} catch (Exception $exception){
//    $response = new JsonResponse(['error' => 'Undefined page'], 404);
//}
//
//$response = $response->withHeader('X-Developer', 'Abbosxon');
//
//$emitter = new SapiEmitter();
//$emitter->emit($response);



// 3-dars
//$params  = [
//    'users' => ['admin' => 'password'],
//    'debug' => true
//];
//
//$aura = new \Aura\Router\RouterContainer();
//
//$routes = $aura->getMap();
//
//$routes->get('home', '/', new Action\BasicAuthActionDecorator(new Action\HomeAction(), $params['users'] ?? []));
//$routes->get('about', '/about', new Action\BasicAuthActionDecorator(new Action\AboutAction(), $params['users'] ?? []));
//$routes->get('cabinet', '/cabinet', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
//$routes->get('post', '/post', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
//$routes->get('blog', '/blog', new Action\BasicAuthActionDecorator(new Action\Blog\IndexAction, $params['users'] ?? []));
//$routes->get('blog_show', '/blog/{id}', new Action\BasicAuthActionDecorator(new Action\Blog\ShowAction, $params['users'] ?? []))->tokens(['id' => '\d+']);
//
////$routes->get('cabinet', '/cabinet', function (ServerRequestInterface $request) use ($params){
////    $pipeline = new Pipeline();
////
////    $pipeline->pipe(new Middleware\ProfilerMiddleware());
////    $pipeline->pipe(new Middleware\BasicAuthMiddleware($params['users']));
////    $pipeline->pipe(new Action\CabinetAction());
////
////    return $pipeline($request, function () {
////        return new HtmlResponse('Undefined page', 404);
////    });
////});
//
//$router = new AuraRouterAdapter($aura);
//$resolver = new MiddlewareResolver();
//$app = new Application($resolver, new Middleware\NotFoundHandler());
//
//$pipeline = new Pipeline();
//
//$app->pipe($resolver->resolve(Middleware\CredentialsMiddleware::class));
//$app->pipe(new Middleware\ErrorHandlerMiddleware($params['debug']));
//
//$app->pipe($resolver->resolve(Middleware\ProfilerMiddleware::class));
//
//$request = ServerRequestFactory::fromGlobals();
//
//try {
//    $result = $router->match($request);
//
//    foreach ($request->getAttributes() as $attribute => $value){
//        $request = $request->withAttribute($attribute, $value);
//    }
//
//    $app->pipe($result->getHandler());
//} catch (Exception $exception){}
//
//$response = $app->run($request);
//
//$emitter = new SapiEmitter();
//$emitter->emit($response);



$params  = [
    'users' => ['admin' => 'password'],
    'debug' => true
];

$aura = new \Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', new Action\BasicAuthActionDecorator(new Action\HomeAction(), $params['users'] ?? []));
$routes->get('about', '/about', new Action\BasicAuthActionDecorator(new Action\AboutAction(), $params['users'] ?? []));
$routes->get('cabinet', '/cabinet', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
$routes->get('post', '/post', new Action\BasicAuthActionDecorator(new Action\CabinetAction(), $params['users'] ?? []));
$routes->get('blog', '/blog', new Action\BasicAuthActionDecorator(new Action\Blog\IndexAction, $params['users'] ?? []));
$routes->get('blog_show', '/blog/{id}', new Action\BasicAuthActionDecorator(new Action\Blog\ShowAction, $params['users'] ?? []))->tokens(['id' => '\d+']);

//$routes->get('cabinet', '/cabinet', function (ServerRequestInterface $request) use ($params){
//    $pipeline = new Pipeline();
//
//    $pipeline->pipe(new Middleware\ProfilerMiddleware());
//    $pipeline->pipe(new Middleware\BasicAuthMiddleware($params['users']));
//    $pipeline->pipe(new Action\CabinetAction());
//
//    return $pipeline($request, function () {
//        return new HtmlResponse('Undefined page', 404);
//    });
//});

$router = new AuraRouterAdapter($aura);
$resolver = new MiddlewareResolver();
$app = new Application($resolver, new Middleware\NotFoundHandler());

$pipeline = new Pipeline();

$app->pipe($resolver->resolve(Middleware\CredentialsMiddleware::class));
$app->pipe(new Middleware\ErrorHandlerMiddleware($params['debug']));
$app->pipe($resolver->resolve(Middleware\ProfilerMiddleware::class));
$app->pipe(new \Framework\Http\Middleware\RouteMiddleware($router));
$app->pipe(new \Framework\Http\Middleware\DispatchMiddleware($resolver));

$request = ServerRequestFactory::fromGlobals();
$response = $app->run($request, new Response());

$emitter = new SapiEmitter();
$emitter->emit($response);