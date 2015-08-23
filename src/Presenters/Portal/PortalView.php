<?php

namespace Your\WebApp\Presenters\Portal;

use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Your\WebApp\Controllers\GalleryController\GalleryPresenter;
use Your\WebApp\Controllers\ImagePanorama\ImagePanorama;
use Your\WebApp\Model\Gallery;

class PortalView extends JQueryView
{
    protected function printViewContent()
    {
        parent::printViewContent();

        $discussions = Gallery::find();

        $sql = MySql::executeStatement( 'SELECT Source FROM tblImage ORDER BY RAND() LIMIT 6' );

        $images = [];

        while($a = $sql->fetch( \PDO::FETCH_ASSOC ) )
        {
            $images[] = $a['Source'];
        }

        ?>
        <div class="__container odd">
            <?= new ImagePanorama( $images )?>
        </div>
        <div class="discussion-group __container">
            <h1 style="text-align: center">
                Galerijas
            </h1>
            <a href="gallery/add/" style="margin-top: -30px; float: right;">Pievienot jaunu galeriju</a>
            <?php
            foreach( $discussions as $discussion )
            {
                print new GalleryPresenter( $discussion );
            }
            ?>
            <div class="__clear-floats"></div>
        </div>

        <?php
    }
}