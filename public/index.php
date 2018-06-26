<?php 
declare (strict_types=1);

use DI\ContainerBuilder;
use ExampleApp\HelloWorld;
use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;
use function DI\create;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions([
    HelloWorld::class => create(HelloWorld::class)
]);

$middlewareQueue = [];

$requestHandler = new Relay($middlewareQueue);
$requestHandler->handle(ServerRequestFactory::fromGlobals());

$container = $containerBuilder->build();

$helloWorld = $container->get(HelloWorld::class);

// $helloWorld = new \ExampleApp\HelloWorld();

$helloWorld -> announce();
