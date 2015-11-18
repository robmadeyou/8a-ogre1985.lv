<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\Controllers\GalleryController\GalleryPresenter;
use Your\WebApp\Model\Gallery;

class GalleryCollectionView extends CrudView
{
    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = "Galerijas";
        ?>
        <div class="__container">
            <div class="row" style="height: 150px;">
                <?php

                $discussions = Gallery::find( )->addSort( 'Order' );
                foreach( $discussions as $discussion )
                {
                    print '<div class="col-xs-6 col-md-2 center-align">';
                    print new GalleryPresenter( $discussion );
                    print '</div>';

                }
                ?>
            </div>
            <div class="__clear-floats"></div>

        </div>
        <?php
    }
}