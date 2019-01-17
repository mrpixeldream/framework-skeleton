<?php

//declare(strict_types=1);

ini_set('display_errors', 1);
error_reporting(E_ALL);

use DreamCodeFramework\Application;
use DreamCodeFramework\Configuration\Concrete\FileLoader;
use DreamCodeFramework\Configuration\Manager;
use Symfony\Component\HttpFoundation\Request;

/*
 * Bootstrap the application by invoking Composer's autoloader.
 * We need this to make the use of external libraries (and eventually components for the framework) easier to set up.
 */
require_once __DIR__.'/vendor/autoload.php';

/*
 * The configuration will be loaded with a configuration manager that we create here.
 * This manager is then set in the container later to enable other parts of the application to access it.
 * For now, we will "hardcode" loading from files.
 */
$configurationManager = new Manager();
$configurationManager->addLoader(new FileLoader(__DIR__.'/config/'));
$configurationManager->boot();

/*
 * Make sure to enable all error logging and displaying (yes, just simple displaying on page) when debug mode is enabled.
 */
exit($configurationManager->get('app.mode'));
if ($configurationManager->get('app.mode') === 'debug') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

/*
 * Build a request object from the incoming data.
 */
$request = Request::createFromGlobals();

$application = new Application();
$application->handle($request);
