<?php

namespace Your\WebApp\Layouts;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Layouts\BaseLayout;

class CustomBaseLayout extends BaseLayout
{
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