<?php

namespace Your\WebApp\Presenters\Logout;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Presenters\Forms\Form;
use Your\WebApp\LoginProviders\CustomLoginProvider;

class LogoutPresenter extends Form
{
    protected function createView()
    {
        $user = new CustomLoginProvider();
        $user->logOut();
         throw new ForceResponseException( new RedirectResponse( '/' ) );
    }
}