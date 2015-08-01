<?php

namespace Your\WebApp\Presenters;

use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Rhubarb\Scaffolds\Authentication\LoginProvider;

class IndexPresenter extends ModelFormPresenter
{
    protected function createView()
    {
        return new IndexView();
    }

    protected function configureView()
    {

        $this->attachEventHandler( '', function( $uname, $pass )
        {
            $providerName = LoginProvider::getDefaultLoginProviderClassName();
            $login = new $providerName();

            return $login->login( $uname, $pass );
        });
        return parent::configureView();
    }
}