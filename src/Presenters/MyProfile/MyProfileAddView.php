<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Leaf\Presenters\Controls\Text\Password\Password;
use Rhubarb\Patterns\Mvp\Crud\CrudView;

class MyProfileAddView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            'Username',
            'Forename',
            'Surname',
            'Email',
            new Password( 'Password' )
        );
    }

    protected function printViewContent()
    {
        $this->printFieldset( "",
            [
                'Username',
                'Password',
                'Forename',
                'Surname',
                'Email',
                $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
            ]);
    }

}