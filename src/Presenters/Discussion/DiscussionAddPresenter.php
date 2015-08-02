<?php

namespace Your\WebApp\Presenters\Discussion;

use Rhubarb\Crown\Context;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;

class DiscussionAddPresenter extends ModelFormPresenter
{
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
        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new DiscussionAddView();
    }

    protected function configureView()
    {
        return parent::configureView();
    }

    protected function saveRestModel()
    {
        return parent::saveRestModel();
    }
}