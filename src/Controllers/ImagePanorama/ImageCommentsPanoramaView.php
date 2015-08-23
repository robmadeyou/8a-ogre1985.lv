<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;
use Rhubarb\Stem\Filters\Equals;
use Your\WebApp\Model\Comment;

class ImageCommentsPanoramaView extends ImagePanoramaView
{
    use WithJqueryViewBridgeTrait;

    protected function printViewContent()
    {

        ?>
        <div class="gallery-collection-images">
            <ul>
                <?php
                $counter = 0;
                foreach( $this->images as $image )
                {
                    $class = $counter === 0 ? 'selected' : '';
                    print '<li><img id="img' . $counter . '" class="thumbnail-image ' . $class . '" thumb="' . $counter . '" imgID="' . $image->ImageID . '" src="' .$image->Source. '"></li>';
                    $counter++;
                }
                ?>
            </ul>
        </div>
        <?php

        parent::printViewContent();
        ?>
        <div class="comments-section">
            <h1 class="title">Komenti</h1>
            <div class="comments-bound">
                <?php
                    self::getCommentsForImageID( $this->images[0]->ImageID );
                ?>
            </div>

            <div class="comments-section-new">
                <textarea id="comment-input"></textarea>
                <button type="submit" id="comment-input-submit">Pievienot</button>
            </div>
        </div>
        <?php
    }

    protected function printImage( $img )
    {
        print '<div id="img-' . $img->ImageID .  '" class="image-panorama-image-container" style="width:'.$this->smallWidth.'%"><img src="' . $img->Source . '"></div>';
    }

    /**
     * Implement this and return __DIR__ when your ViewBridge.js is in the same folder as your class
     *
     * @returns string Path to your ViewBridge.js file
     */
    public function getDeploymentPackageDirectory()
    {
        return __DIR__;
    }

    public static function getCommentsForImageID( $ImageID, $print = true )
    {
        $comments = Comment::find( new Equals( 'ImageID', $ImageID ) );
        $builder = "";
        foreach( $comments as $comment )
        {
            $builder .= <<<HTML
                        <div class="comment-outer">
                            <div class="comment-outer-image">
                                <img src="">
                            </div>
                         <p> ' . $comment->Comment . ' </p>
                         </div>
HTML;
        }
        if( $print )
        {
            print $builder;
        }
        else
        {
            return $builder;
        }
    }


}