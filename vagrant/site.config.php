<?php

namespace Your\WebApp;

use Rhubarb\Crown\Exceptions\Handlers\ExceptionHandler;
use Rhubarb\Crown\Logging\Log;
use Rhubarb\Crown\Logging\PhpLog;
use Rhubarb\Stem\StemSettings;

$dbSettings = new StemSettings();
$dbSettings->Host = "localhost";
$dbSettings->Username = "root";
$dbSettings->Password = "";
$dbSettings->Database = "vagrant";

// Add a PHP logger
Log::attachLog( new PhpLog( Log::ERROR_LEVEL ) );

// Switch off exception trapping. You should have this on in the production environment.
ExceptionHandler::disableExceptionTrapping();