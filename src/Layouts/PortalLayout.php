<?php

namespace Your\WebApp\Layouts;

use Rhubarb\Crown\Html\ResourceLoader;

class PortalLayout extends CustomBaseLayout
{
    function __construct()
    {
        parent::__construct();
        ResourceLoader::loadResource( "/static/css/dropzone.css" );
        ResourceLoader::loadResource( "/static/scripts/dropzone.js" );
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
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Ogres 1. Vidusskola</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/portal/"><span class="glyphicon glyphicon-home"></span> Mājas</a></li>
                        <li><a href="/portal/gallery/"><span class="glyphicon glyphicon-picture"></span> Galerijas</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-sunglasses"></span> Kontakti</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Mans Profils<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/users/">Mainīt profilu</a></li>
                                <li><a href="#">Manas bildes</a></li>
                                <li><a href="#">Notifikācijas</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/portal/logout/">Iziet</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="portal-body">
        <?php
            $title = $this->getTitle();
            $left = $this->getLeftSideTitle();
            $right = $this->getRightSideTitle();

             if ($title != "") {
                 print '<div class="__title-container">
                             <span class="left-side-title">' . $left . '</span>
                            <h1>' . $title . '</h1>
                            <span class="right-side-title">' . $right . '</span>
                        </div>';
             }
    }
    protected function printPageHeadingTwo()
    {
        ?>

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
        <footer class="footer">
            <div class="container">
                HELLO!
            </div>
        </footer>
        <?php
    }
}