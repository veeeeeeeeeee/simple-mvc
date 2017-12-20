<?php

function __init__() {
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

	//require PATH_LIB . 'BaseModel.class.php'; // extending from both Person class and Base Model?
	require PATH_LIB . 'BaseController.class.php';

	require PATH_DB . 'Database.class.php';

	$GLOBALS['config'] = include PATH_APP . 'config.php';
	// echo "init works ?!";
	// echo PATH_DB;

	session_start();
}

?>
