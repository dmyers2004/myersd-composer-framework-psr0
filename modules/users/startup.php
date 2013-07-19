<?php 

$loader->add(basename(__DIR__),'modules/');

$container['router']->map('GET','/users', array('\users\controllers\home','index'), 'home:test2');
