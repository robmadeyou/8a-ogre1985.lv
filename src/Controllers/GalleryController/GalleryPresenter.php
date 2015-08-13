<?php

namespace Your\WebApp\Controllers\GalleryController;


use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class GalleryPresenter extends ModelFormPresenter
{
    private $gallery;
    public function __construct( $gallery )
    {
        $this->gallery = $gallery;
        parent::__construct( "" );
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
        return new GalleryView();
    }

    protected function configureView()
    {
        $this->view->gallery = $this->gallery;
        return parent::configureView();
    }

}