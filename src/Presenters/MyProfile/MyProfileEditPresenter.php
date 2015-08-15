<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Your\WebApp\LoginProviders\CustomLoginProvider;

class MyProfileEditPresenter extends MyProfileAddPresenter
{

    protected function createView()
    {
        $user = CustomLoginProvider::getLoggedInUser();
        $model = $this->getRestModel();

        if( $user->UserID != $model->UserID && !$user->IsSuperuser )
        {
            throw new ForceResponseException( new RedirectResponse( '/portal/' . $user->UserID ) );
        }
        return new MyProfileEditView();
    }
}