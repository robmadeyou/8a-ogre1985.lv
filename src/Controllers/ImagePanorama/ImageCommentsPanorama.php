<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Your\WebApp\Model\Image;

class ImageCommentsPanorama extends ImagePanorama
{

    /**
     * @param $imageUrls Image[]
     * @param string $name
     */
    public function __construct($images, $name = "")
    {
        parent::__construct($images, $name);
    }

    protected function createView()
    {
        return new ImageCommentsPanoramaView( $this->imgs );
    }

}