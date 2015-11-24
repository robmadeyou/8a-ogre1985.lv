<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\LoginProviders\CustomLoginProvider;

class GalleryEditPresenter extends GalleryAddPresenter
{
    protected function createView()
    {
        $gallery = $this->getData( 'CreatedBy' );
        if( !CustomLoginProvider::isAdmin() && !$gallery == CustomLoginProvider::getLoggedInUser()->UniqueIdentifier )
        {
            throw new ForceResponseException( new RedirectResponse( '/' ) );
        }

        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new GalleryEditView();
    }

}