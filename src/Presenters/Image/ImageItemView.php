<?php

namespace Your\WebApp\Presenters\Image;

use Rhubarb\Patterns\Mvp\Crud\CrudView;

class ImageItemView extends CrudView
{
    protected function printViewContent()
    {
        $model = $this->raiseEvent( 'GetRestModel' );

        ?>
            <div class="image-single-view">
                <img src="<?= $model->Source ?>">
            </div>
        <?php
    }
}