<?php 

// move us back to the root application level */
chdir('..');

/* load the PSR0 autoloader */
$loader = require 'vendor/autoload.php';

$container = new Pimple();

/* load our router */
$router = new AltoRouter();

/* add class mapping */
$loader->add('core',__DIR__.'/..');

/* include the application startup */
@include('app/startup.php');

/* load all of our modules startups */
$modules = glob('modules/*',GLOB_ONLYDIR);
foreach ($modules as $module) {
	@include($module.'/startup.php');
}

$container['404_object'] = 'home';
$container['404_method'] = 'error';
$container['match'] = $router->match($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);

$dispatcher = new core\dispatcher($container);
