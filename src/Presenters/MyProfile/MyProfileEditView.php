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
        $currentImage = self::$model->Image ? '<img style="max-width:300px" src="' . self::$model->Image . '">' : '';
        $this->printFieldset( "",
            [
                'Bilde' => $currentImage . $this->presenters[ 'Image' ],
                'Vārds' => 'Forename',
                'Uzvārds' => 'Surname',
                'Parole' => 'PasswordPlace',
                'E - pasts' => 'Email',
                $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
            ]);
    }
}