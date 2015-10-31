<?php

namespace Your\WebApp\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Patterns\Layouts\BaseLayout;

class CustomBaseLayout extends BaseLayout
{
    function __construct()
    {
        ResourceLoader::loadResource( "/static/css/bootstrap.css" );
        ResourceLoader::loadResource( "/static/css/base.css" );
    }

    protected function printHead()
    {
        print <<<HTML
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="/static/scripts/bootstrap.js"></script>
HTML;
        parent::printHead();
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