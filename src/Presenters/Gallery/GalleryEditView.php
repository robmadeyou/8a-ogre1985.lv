<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Leaf\Presenters\Controls\Buttons\Button;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Controllers\TableColumns\FixedWidthColumn;
use Your\WebApp\Model\Image;

class GalleryEditView extends GalleryAddView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $images = Image::find( new Equals( 'GalleryID', $this->getData( 'GalleryID' ) ) )->addSort( 'Order' );
        $this->addPresenters(
            $table = new Table( $images, 25, 'Images' ),
            $delete = new Button( 'Dzēst', 'Dzēst', function( $id )
            {
                $image = new Image( $id );
                $image->delete();
            } ),
            $down = new Button( 'down', 'Uz leju', function( $id )
            {
                $image = new Image( $id );
                $image->Order++;
                $image->save();
            } ),
            $up = new Button( 'up', 'Uz augšu', function( $id )
            {
                $image = new Image( $id );
                $image->Order--;
                $image->save();
            })
        );

        $delete->setConfirmMessage( 'Vai jūs tiešam gribat dzēst šo lietotāju?' );

        $table->addTableCssClass( [ 'table' ] );

        $table->Columns = [
            'Bilde' => '<img style="max-width: 250px;" src="{Thumbnail}">',
            'Indekss' => 'Order',
            '&nbsp' => new FixedWidthColumn( $delete ),
            '&nbsp&nbsp' => new FixedWidthColumn( $up ),
            '&nbsp&nbsp&nbsp' => new FixedWidthColumn( $down )
        ];


    }

    protected function printViewContent()
    {
        parent::printViewContent();

        $html = new HtmlPageSettings();
        $html->PageTitle = 'Pievienot vel bildes galerijā';
        ?>
            <div class="__container">
                Bildes jau galerijā<br>
                <div id="image-orders" class="serialization">
                    <?php
                        $images = Image::find( new Equals( 'GalleryID', $this->getData( 'GalleryID' ) ) )->addSort( 'Order' );
                        foreach( $images as $image )
                        {
                            print '<div iiid="' . $image->ImageID . '"><img iiid="' . $image->ImageID . '" src="' . $image->Source . ' "></div>';
                        }
                    ?>
                </div>
                <div class="__clear-floats"></div>
            </div>
        <?php
    }
}
