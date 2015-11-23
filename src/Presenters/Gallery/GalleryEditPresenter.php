<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Crown\Layout\LayoutModule;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\LoginProviders\CustomLoginProvider;

class GalleryEditPresenter extends GalleryAddPresenter
{
    protected function createView()
    {
        $gallery = $this->getData( '' )
        if( CustomLoginProvider::isAdmin() || )
        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new GalleryEditView();
    }

}