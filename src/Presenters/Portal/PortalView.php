<?php

namespace Your\WebApp\Presenters\Portal;

use Rhubarb\Leaf\Views\JQueryView;
use Your\WebApp\Controllers\DiscussionPresenter;
use Your\WebApp\Model\Discussion;

class PortalView extends JQueryView
{
    protected function printViewContent()
    {
        parent::printViewContent();

        $discussions = Discussion::find();

        ?>
        <div class="discussion-group">
            <?php
            foreach( $discussions as $discussion )
            {
                print new DiscussionPresenter( $discussion );
            }
            ?>
        </div>
        <?php
    }
}