<?php

namespace Your\WebApp\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Layouts\BaseLayout;

class DefaultLayout extends BaseLayout
{
    function __construct()
    {
        ResourceLoader::loadResource( "/static/css/base.css" );
    }

    protected function printPageHeading()
    {
        ?>
        <div id="top">
            <?php

            parent::printPageHeading();

            ?>
        </div>
        <div id="content">
        <?php
    }

    protected function printTail()
    {
        parent::printTail();

        ?>
        </div>
        <div id="tail">

        </div>
        <?php
    }

    protected function getLeftSideTitle()
    {
        $pageSettings = new HtmlPageSettings();
        return $pageSettings->PageLeftTitle;
    }

    protected function getRightSideTitle()
    {
        $pageSettings= new HtmlPageSettings();
        return $pageSettings->PageRightTitle;
    }
}