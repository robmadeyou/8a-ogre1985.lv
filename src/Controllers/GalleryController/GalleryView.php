<?php

namespace Your\WebApp\Controllers\GalleryController;

use Rhubarb\Leaf\Views\HtmlView;
use Rhubarb\Stem\Aggregates\Count;
use Rhubarb\Stem\Aggregates\Sum;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Model\Gallery;
use Your\WebApp\Model\Image;

class GalleryView extends HtmlView
{
    /**
     * @var Gallery comment
     */
    public $gallery;

    protected function printViewContent()
    {
        ?>
        <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/">
            <div class="gallery-overlay">
                <p>
                    <?php
                    $images = Image::find( new Equals( 'GalleryID', $this->gallery->UniqueIdentifier ))->calculateAggregates( new Count( 'ImageID' ) )[0];
                    $imgText = $images == 1 ? "bilde" : "bildes";
                    print $images . ' ' . $imgText;
                    ?>
                </p>
            </div>
        </a>
        <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/"><p
                class="gallery-title"><?= htmlspecialchars( $this->gallery->Title ) ?></p></a>
        <a href="/portal/gallery/<?= $this->gallery->UniqueIdentifier ?>/"><img style="width: 100%; height: 100%;"
                src="<?= $this->gallery->getDefaultImage() ?>"></a>
        <?php
    }
}