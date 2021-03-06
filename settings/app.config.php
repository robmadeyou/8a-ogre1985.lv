<?php

namespace Your\WebApp;

use Rhubarb\Crown\Encryption\HashProvider;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Module;
use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;
use Rhubarb\Crown\UrlHandlers\StaticResourceUrlHandler;
use Rhubarb\Patterns\Mvp\Crud\CrudUrlHandler;
use Rhubarb\Scaffolds\AuthenticationWithRoles\AuthenticationWithRolesModule;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Rhubarb\Stem\Repositories\Repository;
use Rhubarb\Stem\Schema\SolutionSchema;
use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Presenters\Img\ImgPresenter;
use Your\WebApp\Presenters\Users\UsersPresenter;
use Your\WebApp\UrlHandlers\ImageUrlHandler;

class YourAppModule extends Module
{
    protected function initialise()
    {
        parent::initialise();

        Repository::SetDefaultRepositoryClassName( MySql::class );
        include_once( "settings/site.config.php" );

        SolutionSchema::registerSchema( 'Default', 'Your\WebApp\Model\DefaultSolutionSchema' );
    }

    protected function registerUrlHandlers()
    {
        parent::registerUrlHandlers();

        // Add a simple home page URL handler. We're using one of the simplest handlers the
        // ClassMappedUrlHandler, but you should look at the other handlers particularly
        // the MvpUrlHandler and CrudUrlHandler

        $login = new ClassMappedUrlHandler( __NAMESPACE__ . '\Presenters\IndexPresenter' );
        $login->setPriority( 11 );

        $this->addUrlHandlers(
            [
                "/" => new ClassMappedUrlHandler( '\Your\WebApp\Presenters\IndexPresenter', [
                    'portal/' => new ClassMappedUrlHandler( 'Your\WebApp\Presenters\Portal\PortalPresenter', [
                        'gallery/' => new CrudUrlHandler( 'Gallery', 'Your\WebApp\Presenters\Gallery', [
                            'change'
                        ] ),
                        'image/'  => new CrudUrlHandler( 'Image', 'Your\WebApp\Presenters\Image' ),
                        'users/' => new ClassMappedUrlHandler( UsersPresenter::class ),
                        'logout/' => new ClassMappedUrlHandler( 'Your\WebApp\Presenters\Logout\LogoutPresenter' )
                    ] ),
                    'img/' => new ImageUrlHandler( ImgPresenter::class ),
                    'users/' => new CrudUrlHandler( 'CustomUser', 'Your\WebApp\Presenters\MyProfile' )
                ] ),
                "/login/" => $login,
            ]
        );
    }

    protected function registerDependantModules()
    {
        Module::registerModule( new LayoutModule( '\Your\WebApp\Layouts\DefaultLayout' ) );
        Module::registerModule( new AuthenticationWithRolesModule( CustomLoginProvider::class ) );
        HashProvider::setHashProviderClassName( 'Rhubarb\Crown\Encryption\Sha512HashProvider' );
    }
}

// Register our module to get our app underway.
Module::registerModule( new YourAppModule() );