<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Leaf\Presenters\Controls\Buttons\Button;
use Rhubarb\Leaf\Views\HtmlView;
use Your\WebApp\Controllers\TableColumns\FixedWidthColumn;
use Your\WebApp\Model\Gallery;

class GalleryChangeView extends HtmlView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            $table = new Table( Gallery::find()->addSort( 'Order' ), 50, 'Table' ),
            $up = new Button( 'Up', 'Up', function( $id )
            {
                $gallery = new Gallery( $id );
                if( $gallery->Order == null )
                {
                    $gallery->Order = 0;
                }
                $gallery->Order--;
                $gallery->save();
            } ),
            $down = new Button( 'down', 'down', function( $id )
            {
                $gallery = new Gallery( $id );
                if( $gallery->Order == null )
                {
                    $gallery->Order = 0;
                }
                $gallery->Order++;
                $gallery->save();
            } ),
            $delete = new Button( 'delete', 'delete', function( $id )
            {
                $g = new Gallery( $id );
                $g->delete();
            })
        );

        $table->addTableCssClass( [ 'table' ] );
        $delete->addCssClassName( 'btn-danger' );
        $delete->setConfirmMessage( 'Vai jūs tiešam gribat dzēst šo galeriju?' );

        $table->Columns = [
            'Nosaukums' => 'Title',
            'Indekss' => 'Order',
            '' => new FixedWidthColumn( $up ),
            ' ' => new FixedWidthColumn( $down ),
            '  ' => new FixedWidthColumn( $delete )
        ];

    }

    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Mainīt galeriju pozīciju';
        ?>
        <div class="__container">
            <?= $this->presenters[ 'Table' ] ?>
        </div>
        <?php
    }
}