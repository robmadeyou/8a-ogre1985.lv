<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\FileUpload\SimpleImageUpload;
use Rhubarb\Leaf\Presenters\Controls\Text\Password\Password;
use Rhubarb\Leaf\Presenters\Controls\Text\TextBox\TextBox;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\Model\CustomUser;
use Your\WebApp\Presenters\Gallery\GalleryAddPresenter;

class MyProfileAddView extends CrudView
{
    protected static $model;
    public function createPresenters()
    {
        parent::createPresenters();

        $image = new SimpleImageUpload( 'Image' );

        self::$model = $this->raiseEvent( 'GetRestModel' );

        $image->attachEventHandler( 'FileUploaded', function( $file, $location )
        {
            $path = "static/images/usrimgs/";
            if( !dir( $path ) )
            {
                mkdir( $path, 0777, true );
            }

            if( GalleryAddPresenter::isFileImage( $location ) )
            {
                $id = self::$model->UniqueIdentifier;
                if( !$id )
                {
                    $id = CustomUser::findLast()->UniqueIdentifier++;
                }
                rename( $location, $path . $id );
            }
        });

        $this->addPresenters(
            $image,
            'Username',
            'Forename',
            'Surname',
            'Email',
            new Password( 'PasswordPlace' )
        );

        foreach( $this->presenters as $presenter )
        {
            if( $presenter instanceof TextBox )
            {
                $presenter->addCssClassName( 'form-control' );
                $presenter->addHtmlAttribute( 'autocomplete', 'off' );
            }
        }

        $this->presenters[ 'Save' ]->setButtonText( 'Saglabāt' );
        $this->presenters[ 'Cancel' ]->setButtonText( 'Atcelt' );
    }

    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Pievienot jaunu profilu';
        ?>
            <div class='__container'>
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <?php
                        $this->printNiceInputs();
                    ?>
                </div>
                <div class="col-sm-2"></div>
                <div class="__clear-floats"></div>
            </div>
        <?php
    }

    protected function printNiceInputs()
    {
        $currentImage = self::$model->Image ? '<img style="max-width:300px" src="' . self::$model->Image . '">' : '';
        $this->printFieldset( "",
            [
                'Profila bilde' => $currentImage . $this->presenters[ 'Image' ],
                'Lietotāja vārds' => 'Username',
                'Parole' => 'PasswordPlace',
                'Vārds' => 'Forename',
                'Uzvārds' => 'Surname',
                'E - pasts' => 'Email',
                $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
            ]);
    }

}