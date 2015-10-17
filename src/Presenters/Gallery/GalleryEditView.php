<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Model\Image;

class GalleryEditView extends GalleryAddView
{
    protected function printViewContent()
    {
        $galleryID = $this->getData( 'GalleryID' );
        print "Bildes jau galerijā<br>";
        foreach ( Image::find( new Equals( 'GalleryID', $galleryID ) ) as $image )
        {
            print '<img style="width:50px; height:50px;" src="' . $image->Source . '">';
        }

        parent::printViewContent();

        $html = new HtmlPageSettings();
        $html->PageTitle = 'Pievienot vel bildes galerijā';
    }

}