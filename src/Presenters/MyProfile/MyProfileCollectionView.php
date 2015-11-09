<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\Model\CustomUser;

class MyProfileCollectionView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            $table = new Table( CustomUser::find(), 25, 'UserTable' )
        );

        $table->addTableCssClass( [ 'table table-striped' ] );

        $this->presenters[ 'UserTable' ]->Columns = [
            'Lietotaja vārds' => 'Username',
            'Vārds' => 'Forename',
            'Uzvārds' => 'Surname',
            'E - pasts' => 'Email',
            '' => '<a href="/users/{UserID}/edit/" class="btn btn-default">Mainīt</a>'
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