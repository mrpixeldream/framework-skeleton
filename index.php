<?php

declare(strict_types=1);

use DreamCodeFramework\Application;
use Symfony\Component\HttpFoundation\Request;

/*
 * Bootstrap the application by invoking Composer's autoloader.
 * We need this to make the use of external libraries (and eventually components for the framework) easier to set up.
 */
require_once __DIR__.'/vendor/autoload.php';

/**
 * Build a request object from the incoming data.
 */
$request = Request::createFromGlobals();

$application = new Application();
$application->handle($request);
