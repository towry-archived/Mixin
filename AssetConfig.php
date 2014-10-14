<?php

class AssetConfig
{
	private $assetpath;

	public function setAssetPath_($path)
	{
		$this->assetpath = $path;
	}

	public function getAssetPath_()
	{
		return $this->assetpath;
	}
}
