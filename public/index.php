e<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . "app" . DIRECTORY_SEPARATOR);
define('CORE', APP . "core" . DIRECTORY_SEPARATOR);
define('CONTROLLER', APP . "controller" . DIRECTORY_SEPARATOR);
define('MODEL', APP . "model" . DIRECTORY_SEPARATOR);
define('HELPERS', APP . "helpers" . DIRECTORY_SEPARATOR);
$modules = [APP, CORE, CONTROLLER, MODEL, HELPERS];
set_include_path(ROOT . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
spl_autoload_register('spl_autoload');
set_error_handler("ErrorHandler::handleError");
set_error_handler("ErrorHandler::handleException");
header("Content-type: application/json; charset:UTF-8");
new Application();