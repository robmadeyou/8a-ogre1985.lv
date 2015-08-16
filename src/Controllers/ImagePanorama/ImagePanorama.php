<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class ImagePanorama extends ModelFormPresenter
{
    protected $imgs = [];

    public function __construct( $imageUrls, $name = "")
    {
        parent::__construct($name);
        $this->imgs = $imageUrls;
    }

    /**
     * Called to create and register the view.
     *
     * The view should be created and registered using RegisterView()
     * Note that this will not be called if a previous view has been registered.
     *
     * @see Presenter::registerView()
     */
    protected function createView()
    {
        return new ImagePanoramaView( $this->imgs );
    }

}