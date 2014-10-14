<?php

class Mixin
{
	static protected $_protos_ = array();

	static protected $_objects_ = array();

	protected function mix($klass)
	{
		$klass_name = $this->getClassName($klass);
		if (! $klass_name) throw new Exception("Not an object", 1);

		$methods = get_class_methods($klass);
		if ($methods === NULL) {
			throw new Exception("Error: " . __LINE__ . " @ " . __FILE__);
		}

		if (count($methods) == 0) {
			return;
		} 

		$exported_methods = $this->getExportedMethods($methods);

		// if (count($exported_methods) == 0) {
		// 	$exported_methods = $methods;
		// }

		$protos = &self::$_protos_;
		foreach ($exported_methods as $method) {
			// #mark
			$protos[$method] = array(
				'class' => $klass_name,
				);
		}
	}

	private function getExportedMethods($methods)
	{
		$export = [];
		foreach ($methods as $method) {
			if (substr($method, -1) === '_') {
				$export[] = $method;
			}
		}

		return $export;
	}

	private function getClassName($obj)
	{
		if (is_string($obj)) {
			return $obj;
		} else {
			return get_class($obj);
		}
	}

	private function getKlassByMethod($method)
	{
		if (! isset(self::$_protos_[$method])) {
			return false;
		} else {
			return self::$_protos_[$method]['class'];
		}
	}

	public function __call($method, $other)
	{
		$method .= '_';
		return $this->callMethod($method, $other);
	}

	private function callMethod($method, $args)
	{
		$klass = $this->getKlassByMethod($method);
		if (!$klass) {
			throw new Exception("Class not exist for method: {$method}", 1);
		}

		$klassObj = $this->getKlassObject($klass);
		// what if the method is static?
		return call_user_func_array(array($klassObj, $method), $args);
	}

	private function getKlassObject($klass)
	{
		if (isset(self::$_objects_[$klass])) {
			return self::$_objects_[$klass];
		} else if (method_exists($klass, 'getInstance')) {
			$instance = forward_static_call(array($klass, 'getInstance'));
			self::$_objects_[$klass] = $instance;
			return $instance;
		} else {
			$instance = new $klass;
			self::$_objects_[$klass] = $instance;
			return $instance;
		}
	}
}
