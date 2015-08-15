<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class MyProfileItemPresenter extends ModelFormPresenter
{
    public function __construct($name = "")
    {
        throw new ForceResponseException( new RedirectResponse( '/users/' ) );
    }

}