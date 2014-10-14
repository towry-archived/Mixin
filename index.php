<?php

require "Mixin.php";
require "Config.php";
require "ViewConfig.php";
require "AssetConfig.php";

$config = new Config();

$config->setViewPath(__DIR__ . "/views");

$path = $config->getViewPath();

echo $path;
