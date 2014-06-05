<?php
if (!is_file($autoloadFile = __DIR__.'/../vendor/autoload.php')) {
    throw new \LogicException('Could not find autoload.php in vendor/. Did you run "composer install"?');
}

require $autoloadFile;

spl_autoload_register(function ($className)
{
	$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
	$path = __DIR__.DIRECTORY_SEPARATOR.$className.'.php';
	if(file_exists($path))
	{
		require_once $path;
	}
});