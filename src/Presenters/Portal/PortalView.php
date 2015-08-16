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

        $sql = MySql::executeStatement( 'SELECT Source FROM tblImage' );

        $images = [];

        while($a = $sql->fetch( \PDO::FETCH_ASSOC ) )
        {
            $images[] = $a['Source'];
        }

        ?>
            <?= new ImagePanorama( $images )?>
        <div class="discussion-group">
            <?php
            foreach( $discussions as $discussion )
            {
                print new GalleryPresenter( $discussion );
            }
            ?>
        </div>
        <?php
    }
}