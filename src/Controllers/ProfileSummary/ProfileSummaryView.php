<?php

namespace Your\WebApp\Controllers\ProfileSummary;

use Rhubarb\Leaf\Views\HtmlView;
use Your\WebApp\Model\CustomUser;

class ProfileSummaryView extends HtmlView
{
    private $userID;
    function __construct( $userID )
    {
        $this->userID = $userID;
    }

    protected function printViewContent()
    {
        if( $this->userID instanceof CustomUser )
        {
            $user = $this->userID;

        }
        else
        {
            $user = new CustomUser( $this->userID );
        }
        ?>
        <div class="center-align" style="padding-top: 6px;">
            <img class="img-circle" src="<?=$user->Image?>" alt="Nevarēju atrast bildi" width="140" height="140">
            <h4><?=$user->getFullName()?></h4>
            <?php
                if( $user->ShowDetails )
                {
                    ?>
                    <p><a href="mailto:<?= $user->Email ?>"><?= $user->Email ?></a></p>
                    <p><?= $user->PhoneNumber ?></p>
                    <?php
                }
            ?>
        </div>
        <?php
    }

}