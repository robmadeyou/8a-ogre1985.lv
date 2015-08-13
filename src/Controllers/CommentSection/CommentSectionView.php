<?php

namespace Your\WebApp\Controllers\CommentSection;

use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;

class CommentSectionView extends JQueryView
{
    use WithJqueryViewBridgeTrait;

    protected function printViewContent()
    {
        ?>
            <div style="display: none;" class="comment-post-placeholder">

            </div>
            <div class="comment-body">

            </div>
        <?php
    }

    /**
     * Implement this and return __DIR__ when your ViewBridge.js is in the same folder as your class
     *
     * @returns string Path to your ViewBridge.js file
     */
    public function getDeploymentPackageDirectory()
    {
        return __DIR__;
    }
}