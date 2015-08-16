<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Your\WebApp\Controllers\ImagePanorama\ImageCommentsPanorama;
use Your\WebApp\Model\Image;

class GalleryItemView extends CrudView
{
    protected function printViewContent()
    {
        $model = $this->raiseEvent( 'GetRestModel' );

        $html = new HtmlPageSettings();
        $html->PageTitle = htmlspecialchars( $model->Title );

        $slideView = new ImageCommentsPanorama( Image::find( new Equals( 'GalleryID', $model->GalleryID ) ) );
        print $slideView;
    }
}