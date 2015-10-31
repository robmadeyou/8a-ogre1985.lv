<?php

namespace Your\WebApp\Presenters\Portal;

use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Your\WebApp\Controllers\GalleryController\GalleryPresenter;
use Your\WebApp\Controllers\ImagePanorama\ImagePanorama;
use Your\WebApp\Helpers\ImageResize;
use Your\WebApp\Model\Gallery;

class PortalView extends JQueryView
{
    protected function printViewContent()
    {
        parent::printViewContent();

        $discussions = Gallery::find( )->setRange( 0, 5 );

        $sql = MySql::executeStatement( 'SELECT Source FROM tblImage ORDER BY RAND() LIMIT 6' );

        $images = [];

        while($a = $sql->fetch( \PDO::FETCH_ASSOC ) )
        {
            $images[] = $a['Source'];
        }

        ?>
        <div class="__container noPadding">
            <?= new ImagePanorama( $images )?>
        </div>
        <div class="discussion-group __container noSpace">
            <div class="center-block clearfix">
                <h1 style="text-align: center">
                    Top 5 Galerijas
                </h1>
                <a href="gallery/add/" class="btn btn-primary pull-right">Pievienot jaunu galeriju</a>
            </div>
            <div class="row" style="height: 150px;">
                <?php
                foreach( $discussions as $discussion )
                {
                    print '<div class="col-xs-6 col-md-2">';
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