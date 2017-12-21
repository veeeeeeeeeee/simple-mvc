<?php

class App {
	//protected $class;
	static $controller;
	static $action;

	public static function start() {
		//echo "(start)";
		self::init();
		self::autoload();
		self::dispatch();
	}

	// init dirs, config
	private static function init() {
		define("DS", DIRECTORY_SEPARATOR);
		define("ROOT", getcwd() . DS);

		define("PATH_APP", ROOT . 'app' . DS);
		define("PATH_PUBLIC", ROOT . 'public' . DS);
		define("PATH_VENDOR", ROOT . 'vendors' . DS);

		//define("PATH_CORE", PATH_VENDOR . 'core');
		define("PATH_DB", PATH_VENDOR . 'database' . DS);
		define("PATH_LIB", PATH_VENDOR . 'lib' . DS);

		define("PATH_MODEL", PATH_APP . 'models' . DS);
		define("PATH_CONTROLLER", PATH_APP . 'controllers' . DS);
		define("PATH_VIEW", PATH_APP . 'views' . DS);

		define("PATH_TEMPLATE", PATH_VIEW . 'templates' . DS);

		//require PATH_LIB . 'BaseModel.class.php'; // extending from both Person class and Base Model?
		require PATH_LIB . 'BaseController.class.php';

		require PATH_DB . 'Database.class.php';

		$GLOBALS['config'] = include PATH_APP . 'config.php';
		// echo "init works ?!";
		// echo PATH_DB;
		define("APP_HOME", $GLOBALS['config']['app-home']); // can be in config.php?

		session_start();
	}

	// handles require
	private static function autoload() {
		spl_autoload_register([__CLASS__, 'load']);
	}
	private static function load($class_name) {
//		if (substr($class_name, -6) == 'Entity') {
//			require_once PATH_MODEL . $class_name . '.php';
//		}
		if (substr($class_name, -10) == 'Controller') {
			require_once PATH_CONTROLLER . $class_name . '.php';
		}
	}

	// calling controller functions
	private static function dispatch() {
		// GET index.php?controller=Person&action=index
		// GET index.php?controller=Person&action=add -- display add form
		// POST index.php?controller=Person&action=add -- with some post data => call add, give some msg, redir to GET again

		self::$controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] . 'Controller' : '';
		self::$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

		//echo self::$controller;
		//echo self::$action;

		if (self::$controller != '') {
			$c = new self::$controller;
			if (self::$action != '') {
				if ($_SERVER['REQUEST_METHOD'] == 'GET') {
					$a = self::$action;
				}
				else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$a = self::$action . '_save';
				}
				$c->$a();
			}
			else {
				$c->index();
			}
		}
	}
}

?>
