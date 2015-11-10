<?php

namespace Your\WebApp\Layouts;

class DefaultLayout extends CustomBaseLayout
{
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
}