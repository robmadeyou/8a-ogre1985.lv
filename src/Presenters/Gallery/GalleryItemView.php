<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Model\Image;

class GalleryItemView extends CrudView
{
    protected function printViewContent()
    {
        $model = $this->raiseEvent( 'GetRestModel' );

        $html = new HtmlPageSettings();
        $html->PageTitle = $model->Title;

        $images = Image::find( new Equals( 'GalleryID', $model->GalleryID ) );

        foreach( $images as $img )
        {
            print '<a href="/portal/image/' . $img->ImageID . '/"><img src="' . $img->Source . '" style="width:150px; height: 150px;"></a>';
        }
    }
}