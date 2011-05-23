<?php
ini_set('display_errors', 1);

spl_autoload_register(function($className) {
    $path = explode('\\', $className);
    if ($path[0] == 'App') {
        $root = realpath(__DIR__ .'/Library').'/';
        array_shift($path);
        $file = $root.implode(DIRECTORY_SEPARATOR, $path).'.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

spl_autoload_register(function($className) {
    $path = explode('\\', $className);
    if ($path[0] == 'Game') {
        $root = realpath(__DIR__ .'/../Library/Game').'/';
        array_shift($path);
        $file = $root.implode(DIRECTORY_SEPARATOR, $path).'.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});