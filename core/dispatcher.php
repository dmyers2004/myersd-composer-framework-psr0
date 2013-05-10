<?php 
namespace core;

class dispatcher {
	
	public function __construct(&$container=null) {

		if (is_array($container['match']['target'])) {
			$object = $container['match']['target'][0];
			$method = $container['match']['target'][1];
		} else {
			$object = $container['404_object'];
			$method = $container['404_method'];
		}

		$controller = (new $object($container))->$method();
	}
	
}
