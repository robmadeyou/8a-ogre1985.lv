<?php

namespace Your\WebApp\Presenters\Img;

use Rhubarb\Leaf\Views\View;
use Your\WebApp\Model\Image;

class ImgView extends View
{
    protected function printViewContent()
    {

        if( isset( $_GET[ 'g' ] ) && is_numeric( $_GET[ 'g' ] ) )
        {
            ob_clean();
            ob_end_clean();
            header( 'Content-Disposition: attachment; filename=image.jpg');
            $image = new Image( $_GET[ 'g' ] );
            echo file_get_contents( '.' . $image->Source );
            ob_flush();
            flush();
        }
        ?>

        <?php
    }
}