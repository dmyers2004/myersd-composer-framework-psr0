<?php
// move us back to the root application level */
chdir('..');

/* load the PSR0 autoloader */
$loader = require 'vendor/autoload.php';

/* setup our dependency container */
$container = new Pimple();

//$container['config'] = new Configurator();

$container['404.object'] = 'app\controllers\home';
$container['404.method'] = 'error';
$container['server'] = $_SERVER;
$container['request'] = $_GET + $_POST;
$container['cookies'] = $_COOKIE;
$container['files'] = $_FILES;
$container['session'] = $_SESSION;
$container['env'] = $_ENV;

/* setup the database connection */

/* first setup the config */
$container['config'] = '';


/* setup our views */
$container['view'] = new stdClass();
$container['data'] = array();
$container['view.status'] = 200;
$container['view.format'] = 'text/html';
$container['view.template'] = null;

$container['logger'] = new \Monolog\Logger('miniSkirt');
$container['logger']->pushHandler(new \Monolog\Handler\StreamHandler('var/logs/'.date('Y-m-d').'.log'));

//$container['logger']->addInfo('This is info');

$container['cache'] = new stdClass();
$container['input'] = new stdClass();
$container['validation'] = new stdClass();
$container['events'] = new stdClass();
$container['sessions'] = new stdClass();
$container['output'] = new stdClass();

/* load our router */
$container['router'] = new AltoRouter();

/* add core class mapping */
$loader->add('core',__DIR__.'/..');

/* include the application startup */
@include('app/startup.php');

/* load all of our modules startups */
$modules = glob('modules/*',GLOB_ONLYDIR);
foreach ($modules as $module) {
	@include($module.'/startup.php');
}

/* run the router */
$container['match'] = $container['router']->match($container['server']['REQUEST_URI'],$container['server']['REQUEST_METHOD']);

/* dispatch our "controller" */
new core\dispatcher($container);
