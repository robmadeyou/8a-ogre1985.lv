<?php

namespace Your\WebApp;

use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Module;
use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;

class YourAppModule extends Module
{
    protected function initialise()
    {
        parent::initialise();

        include_once("settings/site.config.php");
    }

    protected function registerUrlHandlers()
    {
        parent::registerUrlHandlers();

        // Add a simple home page URL handler. We're using one of the simplest handlers the
        // ClassMappedUrlHandler, but you should look at the other handlers particularly
        // the MvpUrlHandler and CrudUrlHandler
        $this->addUrlHandlers(
            [
                "/" => new ClassMappedUrlHandler('\Your\WebApp\Presenters\IndexPresenter')
            ]
        );
    }

    protected function registerDependantModules()
    {
        Module::registerModule( new LayoutModule( '\Your\WebApp\Layouts\DefaultLayout' ) );
    }
}

// Register our module to get our app underway.
Module::registerModule(new YourAppModule());