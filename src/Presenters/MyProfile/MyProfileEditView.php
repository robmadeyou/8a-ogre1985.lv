<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Settings\HtmlPageSettings;

class MyProfileEditView extends MyProfileAddView
{

    protected function printViewContent()
    {
        parent::printViewContent();
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Mainīt profilu';
    }

    protected function printNiceInputs()
    {
        $this->printFieldset( "",
            [
                'Vārds' => 'Forename',
                'Uzvārds' => 'Surname',
                'Parole' => 'PasswordPlace',
                'E - pasts' => 'Email',
                'Telefona numurs' => 'PhoneNumber',
                'Dzimums' => 'Gender',
                $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
            ]);
    }
}