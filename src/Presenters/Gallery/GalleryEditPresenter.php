<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Layout\LayoutModule;
use Your\WebApp\Layouts\PortalLayout;

class GalleryEditPresenter extends GalleryAddPresenter
{
    protected function createView()
    {
        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new GalleryEditView();
    }

}