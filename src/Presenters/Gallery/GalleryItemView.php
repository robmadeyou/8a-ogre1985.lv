<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Controllers\ImagePanorama\ImageCommentsPanorama;
use Your\WebApp\Model\Image;

class GalleryItemView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $model = $this->raiseEvent( 'GetRestModel' );
        $slideView = new ImageCommentsPanorama( Image::find( new Equals( 'GalleryID', $model->GalleryID ) ), 'SlideView' );

        $this->addPresenters( $slideView );
    }

    protected function printViewContent()
    {
        $model = $this->raiseEvent( 'GetRestModel' );

        $html = new HtmlPageSettings();
        $html->PageTitle = htmlspecialchars( $model->Title );
        $html->PageRightTitle = ' <span class="gallery-edit"><a href="edit/">Mainit</a></span>';

        print $this->presenters[ 'SlideView' ];
    }
}