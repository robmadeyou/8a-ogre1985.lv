<?php

namespace Your\WebApp\Presenters\Users;

use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;

class UsersPresenter extends ModelFormPresenter
{

    protected function createView()
    {
        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new UsersView();
    }
}