<?php

namespace Your\WebApp\Presenters\Discussion;

use Rhubarb\Patterns\Mvp\Crud\CrudView;

class DiscussionItemView extends CrudView
{
    protected function printViewContent()
    {
        $data = $this->raiseEvent( 'GetRestModel' );

        ?>
        <div id="discussion-full-width">
            <img src="<?= $data->ImageSource ?>">
        </div>
        <?php
    }

}