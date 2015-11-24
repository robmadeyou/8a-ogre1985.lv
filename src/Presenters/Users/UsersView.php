<?php

namespace Your\WebApp\Presenters\Users;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Views\HtmlView;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Controllers\ProfileSummary\ProfileSummaryPresenter;
use Your\WebApp\Model\CustomUser;

class UsersView extends HtmlView
{
    protected function printViewContent()
    {
        $users = CustomUser::find( new Equals( 'Enabled', 1 ) )->addSort( 'UserID', false );


        $html = new HtmlPageSettings();
        $html->PageTitle = "Visi portāla lietotāji"
        ?>
            <div class="__container">
                <div class="row">
                    <?php
                    foreach( $users as $user )
                    {
                        print '<div class="col-xs-4 col-md-2 center-align">';
                        print new ProfileSummaryPresenter( $user );
                        print '</div>';
                    }
                    ?>
                </div>
            </div>
        <?php
    }
}