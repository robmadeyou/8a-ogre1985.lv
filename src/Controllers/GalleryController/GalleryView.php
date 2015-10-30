<?php

namespace Your\WebApp\Controllers\GalleryController;

use Rhubarb\Leaf\Views\HtmlView;
use Your\WebApp\Model\Gallery;

class GalleryView extends HtmlView
{
    /**
     * @var Gallery comment
     */
    public $gallery;

    protected function printViewContent()
    {
        ?>
            <div class="col-xs-6 col-md-3">
                <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/"><p class="gallery-title"><?= htmlspecialchars( $this->gallery->Title ) ?></p></a>
                <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/"><img src="<?= $this->gallery->getDefaultImage() ?>"></a>
            </div>
        <?php
    }
}