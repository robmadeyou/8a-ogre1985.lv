<?php

namespace Your\WebApp\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;
use Rhubarb\Patterns\Layouts\BaseLayout;
use Your\WebApp\LoginProviders\CustomLoginProvider;

class PortalLayout extends BaseLayout
{
    function __construct()
    {
        ResourceLoader::loadResource( "/static/css/base.css" );
        ResourceLoader::loadResource( "/static/css/dropzone.css" );
    }

    protected function printPageHeading()
    {
        ?>
    <script src="/static/scripts/dropzone.js"></script>
        <style>
            body
            {
                background-image: url("/static/images/background-blur.jpg");
            }
        </style>
        <div id="content">
            <div id="portal-body">
                <div id="portal-title" class="__container noSpace">
                    <div id="title">
                        <a style="float: left; " href="/">
                            <img src="http://www.ogres1v.lv/assets/templates/ogres1vsk/img/o1v_logo.png"/>
                        </a>
                        <h1 style="float: left;">8A Klase</h1>
                    </div>
                    <div id="portal-title-actions">
                        <a href="/users/">Mans Profils</a> |
                        <a href="/portal/logout/">Iziet</a>
                    </div>
                    <div class="__clear-floats"></div>
                </div>
        <div class="__clear-floats"></div>

                <?php
                $title = $this->getTitle();
                $left = $this->getLeftSideTitle();
                $right = $this->getRightSideTitle();

                if ($title != "") {
                    print '<div class="__title-container">
                                ' . $left . '
                               <h1>' . $title . '</h1>
                               ' . $right . '
                           </div>';
                }
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