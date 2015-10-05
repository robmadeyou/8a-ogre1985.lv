<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;

class GalleryEditView extends GalleryAddView
{
    protected function printViewContent()
    {
        parent::printViewContent();

        $html = new HtmlPageSettings();
        $html->PageTitle =  'Pievienot vel bildes galerijā';
    }

}