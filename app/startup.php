<?php 

$loader->add('app',__DIR__.'/../');

// mapping routes
$container['router']->map('GET|POST','/', array('\app\controllers\home','index'), 'home');
$container['router']->map('GET','/test', array('\app\controllers\home','test'), 'home:test');
$container['router']->map('GET','/dump', array('\app\controllers\home','dump'));
$container['router']->map('GET|POST','/group/[i:id]', array('\app\controllers\home','group'),'home:group');

