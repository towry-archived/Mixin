<?php

class ViewConfig
{
	private $viewpath;

	static private $instance;

	static public function getInstance($options = array())
	{
		if (!isset(self::$instance)) {
			self::$instance = new self();
		} 

		return self::$instance;
	}

	public function setViewPath_($path)
	{
		$this->viewpath = $path;
	}

	public function getViewPath_()
	{
		return $this->viewpath;
	}

	public function helloFromViewConfig_()
	{
		echo "Hi!";
	}
}
