<?php

namespace Your\WebApp\Presenters\Portal;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Your\WebApp\Controllers\GalleryController\GalleryPresenter;
use Your\WebApp\Controllers\ImagePanorama\ImagePanorama;
use Your\WebApp\Controllers\ProfileSummary\ProfileSummaryPresenter;
use Your\WebApp\Helpers\ImageResize;
use Your\WebApp\Model\CustomUser;
use Your\WebApp\Model\Gallery;

class PortalView extends JQueryView
{
    protected function printViewContent()
    {
        parent::printViewContent();

        $discussions = Gallery::find( )->setRange( 0, 6 );
        $users = CustomUser::find()->addSort( 'UserID', false )->setRange( 0, 6 );

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
        <div class="discussion-group __container">
            <div class="center-block clearfix relative">
                <h1 style="text-align: center">
                    Top 6 Galerijas
                </h1>
                <a href="gallery/add/" class="btn btn-primary right-side-title">Pievienot galeriju</a>
            </div>
            <div class="row" style="height: 150px; text-align: center">
                <?php
                foreach( $discussions as $discussion )
                {
                    print '<div class="col-xs-5 col-md-2 center-align">';
                        print new GalleryPresenter( $discussion );
                    print '</div>';
                }
                ?>
            </div>

            <div class="__clear-floats"></div>
        </div>
        <div class="__container">
            <div class="center-block clearfix relative">
                <h1 style="text-align: center">
                    6 Jaunākie biedri portālā!
                </h1>
                <a href="/portal/users/" class="btn btn-primary right-side-title">Redzēt visus</a>
            </div>
            <div class="row">
                <?php
                    foreach( $users as $user )
                    {
                        print '<div class="col-xs-5 col-md-2 center-align">';
                            print new ProfileSummaryPresenter( $user );
                        print '</div>';
                    }
                ?>
            </div>
        </div>

        <?php
    }
}