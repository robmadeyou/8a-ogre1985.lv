<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Rhubarb\Leaf\Views\JQueryView;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;

class ImagePanoramaView extends JQueryView
{

    use WithJqueryViewBridgeTrait;

    private $images = [];
    /**
     *
     */
    function __construct( $images )
    {
        $this->images = $images;
    }

    protected function printViewContent()
    {
        $largeWidth = 100 * sizeof( $this->images );
        $smallWidth = 100 / sizeof( $this->images );
        ?>
            <div class="image-panorama">
                <div style="display: none;" id="max-gallery-elements"><?= sizeof( $this->images ) - 1?></div>
                <div class="image-panorama-images" style="width: <?= $largeWidth?>%;">
                    <?php
                        foreach( $this->images as $img )
                        {
                            print '<img src="' . $img . '" style="width:'.$smallWidth.'%">';
                        }
                    ?>
                </div>
                <div class="image-panorama-navigation">
                    <button class="image-panorama-prev">Prev</button>
                    <button class="image-panorama-next">Next</button>
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