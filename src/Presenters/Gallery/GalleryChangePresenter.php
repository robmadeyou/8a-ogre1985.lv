<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\LoginProviders\CustomLoginProvider;

class GalleryChangePresenter extends ModelFormPresenter
{
    protected function createView()
    {
        if ( !CustomLoginProvider::isAdmin() )
        {
            throw new ForceResponseException( new RedirectResponse( '../' ) );
        }

        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new GalleryChangeView();
    }
}