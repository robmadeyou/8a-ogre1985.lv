<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Model\Image;

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

    protected function configureView()
    {
        $this->view->raiseEvent( 'DeleteImage', function( $imgID )
        {
            try
            {
                $image = new Image( $imgID );
                $image->delete();
                return true;
            }
            catch( RecordNotFoundException $ex )
            {
                return false;
            }
        });

        return parent::configureView();
    }
}