<?php
namespace framework;

final class App
{
	public static function run()
	{

		spl_autoload_register(__NAMESPACE__.'\\App::appLoader');
		spl_autoload_register(__NAMESPACE__.'\\App::frameworkLoader');

		self::initDI();

		$controller = ucfirst($_GET['c']).'Controller';
		$action = $_GET['a'].'Action';

		$className = '\app\controllers\\'.$controller;

		(new $className())->$action();
	}

	public static function initDI()
	{
		core\DI::set('db', function () {
			return \framework\component\DB::getInstance();
		});

		core\DI::set('config', function () {
			return core\Config(APP_PATH.'src/config.php');
		});

		dd(core\DI::get('config'));
	}

	public static function appLoader($class)
	{
		$prefix = 'app\\';

		// base directory for the namespace prefix
		$base_dir = APP_PATH.'src/';

		// does the class use the namespace prefix?
		$len = strlen($prefix);
		if (strncmp($prefix, $class, $len) !== 0) {
		    // no, move to the next registered autoloader
		    return;
		}

		// get the relative class name
		$relative_class = substr($class, $len);

		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php
		$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

		// if the file exists, require it
		if (file_exists($file)) {
			require $file;
		}
	}

	public static function frameworkLoader($class)
	{
		$prefix = 'framework\\';

		$base_dir = ROOT_PATH.'framework/';

		// does the class use the namespace prefix?
		$len = strlen($prefix);
		if (strncmp($prefix, $class, $len) !== 0) {
		// no, move to the next registered autoloader
		 	return;
		}

		// get the relative class name
		$relative_class = substr($class, $len);

		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php
		$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

		// if the file exists, require it
		if (file_exists($file)) {
			require $file;
		}
	}

}