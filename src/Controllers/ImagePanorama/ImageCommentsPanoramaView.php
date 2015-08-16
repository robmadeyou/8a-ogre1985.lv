<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;

class ImageCommentsPanoramaView extends ImagePanoramaView
{
    use WithJqueryViewBridgeTrait;

    public function getDeploymentPackage()
    {
        $pack = parent::getDeploymentPackage();
        $pack->resourcesToDeploy[] = __DIR__ . '/ImageCommentsPanoramaViewBridge.js';

        return $pack;
    }

    protected function printViewContent()
    {

        ?>
        <div class="gallery-collection-images">
            <ul>
                <?php
                $counter = 0;
                foreach( $this->images as $image )
                {
                    $class = $counter === 0 ? 'selected' : '';
                    print '<li><img class="thumbnail-image ' . $class . '" thumb="' . $counter . '" src="' .$image->Source. '"></li>';
                    $counter++;
                }
                ?>
            </ul>
        </div>
        <?php

        parent::printViewContent();
    }

    protected function printImage( $img )
    {
        print '<div id="img-' . $img->ImageID .  '" class="image-panorama-image-container" style="width:'.$this->smallWidth.'%"><img src="' . $img->Source . '"></div>';
    }

}