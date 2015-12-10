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
        $slideView = new ImageCommentsPanorama( Image::find( new Equals( 'GalleryID', $model->GalleryID ) )->addSort( 'Order' ), 'SlideView' );

        $this->addPresenters( $slideView );
    }

    protected function printViewContent()
    {
        $model = $this->raiseEvent( 'GetRestModel' );

        $html = new HtmlPageSettings();
        if( $model->Title )
        {
            $html->PageTitle = htmlspecialchars( $model->Title );
        }
        else
        {
            $html->PageTitle = "&nbsp;";
        }
        $html->PageRightTitle = '<a href="edit/" class="btn btn-default btn-sm">Mainīt</a>';

        print $this->presenters[ 'SlideView' ];
    }
}