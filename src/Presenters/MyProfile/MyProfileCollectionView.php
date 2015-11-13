<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Leaf\Presenters\Controls\Buttons\Button;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Controllers\TableColumns\FixedWidthColumn;
use Your\WebApp\Model\Comment;
use Your\WebApp\Model\CustomUser;

class MyProfileCollectionView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            $table = new Table( CustomUser::find( new Equals( 'Enabled', true )), 25, 'UserTable' ),
            $delete = new Button( 'Dzēst', 'Dzēst', function( $a )
            {
                try
                {
                    $user = new CustomUser( $a );
                    $user->Enabled = false;
                    $user->save();
                }
                catch( RecordNotFoundException $ex )
                {}
            }),
            $edit = new Button( 'Mainīt', 'Mainīt', function( $a )
            {
                throw new ForceResponseException( new RedirectResponse( '/users/' . $a . '/edit/' ) );
            })
        );

        $delete->addCssClassName( 'btn-danger' );
        $delete->setConfirmMessage( 'Vai jūs tiešam gribat dzēst šo lietotāju?' );

        $table->addTableCssClass( [ 'table table-striped table-bordered' ] );

        $this->presenters[ 'UserTable' ]->Columns = [
            'Lietotaja vārds' => 'Username',
            'Vārds' => 'Forename',
            'Uzvārds' => 'Surname',
            'E - pasts' => 'Email',
            '' => new FixedWidthColumn( $edit ),
            ' ' => new FixedWidthColumn( $delete )
        ];
    }

    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Mainīt lietotājus';
        ?>
            <div class="__container">
                <div class="center-block clearfix relative">
                    <a href="/users/add/" class="btn btn-primary right-side-title">Pievienot jaunu profilu</a>
                </div>
                <?= $this->presenters[ 'UserTable' ]; ?>
            </div>
        <?php
    }
}