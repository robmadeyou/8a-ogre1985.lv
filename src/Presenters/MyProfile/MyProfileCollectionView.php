<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Leaf\Presenters\Application\Table\Table;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\Model\CustomUser;

class MyProfileCollectionView extends CrudView
{
    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            new Table( CustomUser::find(), 25, 'UserTable' )
        );

        $this->presenters[ 'UserTable' ]->Columns = [
            'Lietotaja vards' => 'Username',
            'Vards' => 'Forename',
            'Uzvards' => 'Surname',
            'E pasts' => 'Email',
            '' => '<a href="/users/{UserID}/edit/">Mainit</a>'
        ];
    }

    protected function printViewContent()
    {
        ?>
            <div class="__container">
                <a href="/users/add/">Pievienot jaunu profilu</a>
                <?= $this->presenters[ 'UserTable' ]; ?>
            </div>
        <?php
    }
}