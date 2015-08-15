<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;

class MyProfileCollectionPresenter extends ModelFormPresenter
{
    public function __construct($name = "")
    {
        LayoutModule::setLayoutClassName( PortalLayout::class );
        parent::__construct($name);
    }

    protected function createView()
    {
        return new MyProfileCollectionView();
    }
}