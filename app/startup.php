<?php 

$loader->add('app',__DIR__.'/../');

// mapping routes
$router->map('GET|POST','/', array('\app\controllers\home','index'), 'home');
$router->map('GET','/test', array('\app\controllers\home','test'), 'home:test');
