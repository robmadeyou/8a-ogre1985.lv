<?php

namespace Your\WebApp\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;

class PortalLayout extends BaseLayout
{
    function __construct()
    {
        ResourceLoader::loadResource( "/static/css/base.css" );
    }

    protected function printPageHeading()
    {
        ?>
        <style>
            body
            {
                background-image: url("/static/images/background-blur.jpg");
            }
        </style>
        <div id="content">
            <div id="portal-body">
                <div id="portal-title">
                    <div id="title">
                        <h1>Ogres Vidusskolas 8a klase</h1>
                    </div>
                    <div id="portal-title-actions">
                        <a href="profile/">Mans Profils</a> |
                        <a href="logout/">Iziet</a>
                    </div>
                </div>
                <?php
                parent::printPageHeading();
                ?>
        <?php
    }

    protected function printContent( $content )
    {
       ?>

            <div id="portal-content-body">
                <?php
                  parent::printContent( $content );
                ?>
            </div>
        </div>

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
}