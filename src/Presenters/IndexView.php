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
        $htmlPageSettings->PageTitle = "";

        ?>
            <div id="login-panel">
                <div id="login-panel-bg"></div>
                <div id="login-panel-fg">
                    <h1>Sveiki!</h1>
                    <p>Ielogoties seit</p>
                    <div id="inputs">
                        <div class="__group">
                            <label for="name">Vards</label>
                            <input type="text" id="name">
                        </div>
                        <div class="__group">
                            <label for="password">Parole</label>
                            <input type="password" id="password">
                        </div>
                        <button id="log-in">Ienākt</button>
                    </div>
                </div>
            </div>
        <?php
    }
}
