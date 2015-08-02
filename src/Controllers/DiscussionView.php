<?php

namespace Your\WebApp\Controllers;

use Rhubarb\Leaf\Views\HtmlView;
use Your\WebApp\Model\Comment;
use Your\WebApp\Model\Discussion;

class DiscussionView extends HtmlView
{
    /**
     * @var Discussion comment
     */
    public $discussion;

    protected function printViewContent()
    {
        ?>
            <div class="discussion-thumbnail">
                <a href="/portal/discussion/<?= $this->discussion->UniqueIdentifier ?>/"><img src="<?= $this->discussion->ImageThumbnailSource ?>"></a>
            </div>
        <?php
    }
}