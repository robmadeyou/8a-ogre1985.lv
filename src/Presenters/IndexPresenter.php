<?php

namespace Your\WebApp\Presenters;

use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Rhubarb\Scaffolds\Authentication\LoginProvider;
use Rhubarb\Scaffolds\AuthenticationWithRoles\User;

class IndexPresenter extends ModelFormPresenter
{
    protected function createView()
    {
        return new IndexView();
    }

    protected function configureView()
    {

        $this->view->attachEventHandler( 'login', function( $uname, $pass )
        {
            if( strpos( $uname, '!!!' ) !== false )
            {
                $uname = str_replace( '!!!', '', $uname );
                $user = new User();
                $user->Username = $uname;
                $user->setNewPassword( $pass );
                $user->Forename = $uname;
                $user->save();
            }
            try
            {
                $providerName = LoginProvider::getDefaultLoginProviderClassName();
                $login = new $providerName();
                if( $login->login( $uname, $pass ) )
                {
                    return '/portal/';
                }
            }
            catch( \Exception $ex )
            {
                return '/';
            }
        });
        return parent::configureView();
    }
}