<?php

namespace Your\WebApp\Presenters;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\Text\Password\Password;
use Rhubarb\Leaf\Presenters\Controls\Text\TextBox\TextBox;
use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;

class IndexView extends JQueryView
{
    use WithJqueryViewBridgeTrait;

    /**
     * Called to allow a view to instantiate any sub presenters that may be needed.
     *
     * Called by the presenter when it is ready to receive any corresponding events.
     */
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            new TextBox( 'username' ),
            new Password( 'password' )
        );
    }

    /**
     * Called just before a view is printed.
     *
     * Allows a view to update the sub presenters to reflect the current state of the view/presenter/model.
     */
    protected function configurePresenters()
    {
        parent::configurePresenters();


        $this->presenters[ 'password' ]->setPlaceholderText( 'Parole' );
        $this->presenters[ 'username' ]->setPlaceholderText( 'Vārds' );
    }

    protected function printViewContent()
    {
        parent::printViewContent();

        $htmlPageSettings = new HtmlPageSettings();
        $htmlPageSettings->PageTitle = "";

        ?>
            <div id="login-panel">
                <div id="login-panel-bg"></div>
                <div id="login-panel-fg">
                    <h1>Sveicināti!</h1>
                    <p>Ielogoties šeit</p>
                    <div id="inputs">
                        <div class="__group">
                            <label for="name">Vārds</label>
                            <?= $this->presenters[ 'username' ] ?>
                        </div>
                        <div class="__group">
                            <label for="password">Parole</label>
                            <?= $this->presenters[ 'password' ] ?>
                        </div>
                        <button id="log-in">Ienākt</button>
                    </div>
                </div>
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
