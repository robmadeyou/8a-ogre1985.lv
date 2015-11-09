<?php

namespace Your\WebApp\Presenters\Img;

use Rhubarb\Crown\Http\HttpResponse;
use Rhubarb\Crown\Layout\Layout;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\Response;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class ImgPresenter extends ModelFormPresenter
{
    protected function createView()
    {
        LayoutModule::disableLayout();
        return new ImgView();
    }

    public function __construct( $name = "" )
    {
        parent::__construct( $name );
    }
}