<?php

namespace Your\WebApp\Controllers;


use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class DiscussionPresenter extends ModelFormPresenter
{
    private $discussion;
    public function __construct( $discussion )
    {
        $this->discussion = $discussion;
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
        return new DiscussionView();
    }

    protected function configureView()
    {
        $this->view->discussion = $this->discussion;
        return parent::configureView();
    }

}