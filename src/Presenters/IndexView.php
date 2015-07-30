<?php

namespace Your\WebApp\Presenters;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Views\HtmlView;

class IndexView extends HtmlView
{
    protected function printViewContent()
    {
        parent::printViewContent();

        $htmlPageSettings = new HtmlPageSettings();
        $htmlPageSettings->PageTitle = "You're up and running!";

        ?>
        <p>Add more URLs by configuring URL Handlers in the settings/app.config.php file</p>

        <?php
    }
}