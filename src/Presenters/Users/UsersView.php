<?php

namespace Your\WebApp\Presenters\Users;

use Rhubarb\Leaf\Views\HtmlView;
use Your\WebApp\Controllers\ProfileSummary\ProfileSummaryPresenter;
use Your\WebApp\Model\CustomUser;

class UsersView extends HtmlView
{
    protected function printViewContent()
    {
        $users = CustomUser::find()->addSort( 'UserID', false )->setRange( 0, 6 );

        ?>
            <div class="__container">
                <div class="center-block clearfix relative">
                    <h1 style="text-align: center">
                        Visi portāla lietotāji
                    </h1>
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