<?php
class AutoLoader
{
    protected $rootPath;

    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function registerNamespaces()
    {
        $this->registerApplicationNamespace();
        $this->registerLibraryNamespace();
    }

    protected function getAutoloader($namespace, $directory)
    {
        return function($className) use ($namespace, $directory) {
            $path = explode('\\', $className);
            if ($path[0] == $namespace) {
                array_shift($path);
                $file = $directory.implode(DIRECTORY_SEPARATOR, $path).'.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        };
    }

    public function registerApplicationNamespace()
    {
        $autoloader = $this->getAutoloader('App', $this->rootPath .'/Application/Library/');
        $this->registerAutoloader($autoloader);
    }

    public function registerLibraryNamespace()
    {
        $autoloader = $this->getAutoloader('Game', $this->rootPath .'/Library/Game/');
        $this->registerAutoloader($autoloader);
    }

    protected function registerAutoloader($autoloader)
    {
        \spl_autoload_register($autoloader);
    }
}