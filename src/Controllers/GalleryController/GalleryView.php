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
        <a href="<?= $this->gallery->UniqueIdentifier ?>">
            <div class="gallery-overlay">
            </div>
        </a>
        <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/"><p
                class="gallery-title"><?= htmlspecialchars( $this->gallery->Title ) ?></p></a>
        <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/"><img style="width: 100%; height: 100%;"
                src="<?= $this->gallery->getDefaultImage() ?>"></a>
        <?php
    }
}