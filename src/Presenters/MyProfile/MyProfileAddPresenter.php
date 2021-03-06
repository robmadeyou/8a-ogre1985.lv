<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Presenters\Portal\PortalPresenter;

class MyProfileAddPresenter extends ModelFormPresenter
{
    public function __construct($name = "")
    {
        LayoutModule::setLayoutClassName( PortalLayout::class );
        parent::__construct($name);
    }

    protected function createView()
    {
        if( !CustomLoginProvider::isAdmin() )
        {
            $user = CustomLoginProvider::getLoggedInUser();
            throw new ForceResponseException( new RedirectResponse( '/users/' . $user->UniqueIdentifier . '/edit/' ) );
        }
        return new MyProfileAddView();
    }

    protected function saveRestModel()
    {
        $user = parent::saveRestModel();
        if( $user->PasswordPlace )
        {
            $user->setNewPassword( $user->PasswordPlace );
        }
        $user->Image = '/static/images/usrimgs/' . $user->UniqueIdentifier;
        $user->save();
    }


    protected function redirectAfterCancel()
    {
        throw new ForceResponseException( new RedirectResponse( '/portal/' ) );
    }
}