<?php

namespace app\controllers;

class home {

	public $container;

	public function __construct(&$container) {
		$this->container = $container;
	}

	public function index() {
		echo 'welcome from index';
	}

	public function test() {
		echo 'welcome from test';
	}
	
	public function error() {
		echo '404 Not Found';
	}
	
}

