<?php

class Config extends Mixin
{
	private $_mixins_ = array(
		"ViewConfig",
		"AssetConfig",
		);

	public function __construct($mixins = array())
	{
		array_merge($this->_mixins_, $mixins);
		foreach ($this->_mixins_ as $mixin) {
			$this->mix($mixin);
		}
	}
}
