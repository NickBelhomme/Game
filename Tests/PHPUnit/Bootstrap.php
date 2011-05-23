<?php
ini_set('display_errors', 1);
require_once '../../Application/AutoLoader.php';
$autoLoader = new AutoLoader(realpath(__DIR__.'/../../'));
$autoLoader->registerNamespaces();

define('TEST_PATH', __DIR__.'/Library/Game');