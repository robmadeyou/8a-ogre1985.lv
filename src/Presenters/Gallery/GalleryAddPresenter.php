<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\Model\Image;

class GalleryAddPresenter extends ModelFormPresenter
{

    protected function createView()
    {
        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new GalleryAddView();
    }

    protected function configureView()
    {
        return parent::configureView();
    }

    protected function saveRestModel()
    {

        $model = parent::saveRestModel();

        foreach( GalleryAddView::$createdImagesForGallery as $id )
        {
            $image = new Image( $id );
            $image->GalleryID = $model->GalleryID;
            $image->save();
        }

        return $model;
    }

    protected function redirectAfterCancel()
    {
        throw new ForceResponseException( new RedirectResponse( '/portal/' ) );
    }

}