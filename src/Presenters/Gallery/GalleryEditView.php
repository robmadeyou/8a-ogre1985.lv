<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Model\Image;

class GalleryEditView extends GalleryAddView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $images = Image::find( new Equals( 'GalleryID', $this->getData( 'GaleryID' ) ) );
        $this->addPresenters(
            $table = new Table( $images, 25, 'Images' )
        );

        $table->Columns = [

        ];
    }

    protected function printViewContent()
    {
        $galleryID = $this->getData( 'GalleryID' );
        print "Bildes jau galerijā<br>";
        foreach (  ) as $image )
        {
            print '<img style="width:50px; height:50px;" src="' . $image->Source . '">';
        }


        parent::printViewContent();

        $html = new HtmlPageSettings();
        $html->PageTitle = 'Pievienot vel bildes galerijā';
    }
}