<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;

class ImagePanoramaView extends JQueryView
{

    use WithJqueryViewBridgeTrait;

    public $images = [],
            $largeWidth,
            $smallWidth;
    /**
     *
     */
    function __construct( $images )
    {
        $this->images = $images;
        $this->largeWidth = 100 * sizeof( $images );
        $this->smallWidth = 100 / sizeof( $images );
    }

    protected function printViewContent()
    {

        ?>
         <div class="portal-image-gallery">
            <div class="image-panorama">
                <div style="display: none;" id="max-gallery-elements"><?= sizeof( $this->images ) - 1?></div>
                <div class="image-panorama-images" style="width: <?= $this->largeWidth?>%;">
                    <?php
                        foreach( $this->images as $img )
                        {
                            $this->printImage( $img );
                        }
                    ?>
                </div>
                <div class="image-panorama-navigation">
                    <?= $this->printNavigationbuttons() ?>
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

    protected function printImage( $img )
    {
        print '<div class="image-panorama-image-container" style="width:'.$this->smallWidth.'%"><img src="' . $img . '"></div>';
    }

    protected function printNavigationbuttons()
    {
        ?>
            <button class="image-panorama-prev">Atpakaļ</button>
            <button class="image-panorama-next">Uz priekšu</button>
        <?php
    }

}