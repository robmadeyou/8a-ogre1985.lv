<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Leaf\Presenters\Controls\Buttons\Button;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\Controllers\TableColumns\FixedWidthColumn;
use Your\WebApp\Model\Comment;
use Your\WebApp\Model\CustomUser;

class MyProfileCollectionView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            $table = new Table( CustomUser::find(), 25, 'UserTable' ),
            $delete = new Button( 'Dzēst', 'Dzēst', function( $a )
            {
                $comment = new Comment();
                $comment->Comment = $a;
                $comment->save();
            }),
            $edit = new Button( 'Mainīt', 'Mainīt', function( $a )
            {
                throw new ForceResponseException( new RedirectResponse( '/users/' . $a . '/edit/' ) );
            })
        );

        $delete->addCssClassName( 'btn-danger' );

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
        ?>
            <div class="__container">
                <div class="center-block clearfix relative">
                    <h1 style="text-align: center">
                        Mainīt lietotājus
                    </h1>
                    <a href="/users/add/" class="btn btn-primary right-side-title">Pievienot jaunu profilu</a>
                </div>
                <?= $this->presenters[ 'UserTable' ]; ?>
            </div>
        <?php
    }
}