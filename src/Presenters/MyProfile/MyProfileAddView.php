<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\FileUpload\SimpleImageUpload;
use Rhubarb\Leaf\Presenters\Controls\Text\Password\Password;
use Rhubarb\Patterns\Mvp\Crud\CrudView;

class MyProfileAddView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $image = new SimpleImageUpload( 'Image' );

        $this->addPresenters(
            $image,
            'Username',
            'Forename',
            'Surname',
            'Email',
            new Password( 'Password' )
        );

        $this->presenters[ 'Save' ]->setButtonText( 'Saglabat' );
        $this->presenters[ 'Cancel' ]->setButtonText( 'Atcelt' );

    }

    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Pievienot jaunu profilu';
        $this->printFieldset( "",
            [
                'Profila bilde' => 'Image',
                'Lietotaja vards' => 'Username',
                'Parole' => 'Password',
                'Vards' => 'Forename',
                'Uzvards' => 'Surname',
                'E - pasts' => 'Email',
                $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
            ]);
    }

}