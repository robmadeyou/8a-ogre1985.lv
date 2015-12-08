<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Rhubarb\Leaf\Presenters\Controls\FileUpload\DragAndDropFileUploadPresenter;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;
use Rhubarb\Stem\Aggregates\Count;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Model\Comment;
use Your\WebApp\Model\CustomUser;
use Your\WebApp\Model\Gallery;
use Your\WebApp\Model\Image;

class ImageCommentsPanoramaView extends ImagePanoramaView
{
    use WithJqueryViewBridgeTrait;

    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            new DragAndDropFileUploadPresenter()
        );
    }

    protected function printViewContent()
    {
        $user = CustomLoginProvider::getLoggedInUser();
        $firstImg = 0;

        ?>
        <div class="__container" style="padding-bottom: 10px">
            <?php

            parent::printViewContent();

            ?>
            <div class="gallery-collection-images">
                <ul>
                    <?php
                    $counter = 0;
                    foreach( $this->images as $image )
                    {
                        if( $firstImg === 0 )
                        {
                            $firstImg = $image->ImageID;
                        }

                        $class = $counter === 0 ? 'selected' : '';
                        $commentNums = MySql::returnSingleValue( "SELECT COUNT( CommentID ) FROM tblComment WHERE ImageID = '" . $image->ImageID . "'" );
                        $commentNums = $commentNums == 1 ? $commentNums . " komentārs" : $commentNums . " komentāri";
                        print '<li class="thumbnail-image-container">
                                    <a href="#' . $counter . '">
                                        <img id="img' . $counter . '" class="thumbnail-image img-thumbnail ' . $class . '" thumb="' . $counter . '" imgID="' . $image->ImageID . '" src="' .$image->GetResizedImage( 1 ). '">
                                    </a>
                                    <span>' . $commentNums . ' </span>
                               </li>';
                        $counter++;
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="__container">
                    <div class="row">
                        <div class="col-xs-6 center-align">
                            <a href="/img/?g=<?= $this->images[0]->ImageID ?>" id="downloadButton" ><i class="fa fa-download"></i> Lejuplādēd </a>
                        </div>
                        <div class="col-xs-6 center-align">
                            <a href="#" class="" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Pievienot bilde(s)</a>
                        </div>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Pievienot bildes galerijai</h4>
                                    </div>
                                    <div id="dropzone">
                                        <div action="/portal/gallery/<?= $this->images[ 0 ]->GalleryID ?>/?a=<?= $this->images[ 0 ]->GalleryID ?>" class="dropzone" id="image-upload">
                                            <div class="dz-message">Bildes parādisies šeit<br />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save-mode-button">Saglabāt!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comments-section col-md-8">
                <div class="comments-bound __container" style="min-height: 46px;">
                    <?php
                        self::getCommentsForImageID( $this->images[0]->ImageID );
                    ?>
                </div>
                <div class="comments-section-new __container">
                    <div class="comment-outer-image">
                        <img src="<?= $user->Image ?>">
                    </div>
                    <textarea id="comment-input"></textarea>
                    <button type="submit" id="comment-input-submit">Pievienot</button>
                    <div class="__clear-floats"></div>
                </div>
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

    public static function getCommentsForImageID( $ImageID, $print = true, $nested = false )
    {
        $comments = Comment::find( new Equals( 'ImageID', $ImageID ) );

        if( !$nested && $comments->calculateAggregates( new Count( 'CommentID' ) )[ 0 ] == 0 )
        {
            return '<h3 class="center-align">Tukšs</h3>';
        }

        $builder = "";
        foreach( $comments as $comment )
        {
            if( $comment->InReplyTo == 0 )
            {
                $builder .= self::getCommentsForCommentID( $comment, $print, true );
            }
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

    public static function getUploadedByInfo( $imageID )
    {
        try
        {
            $image = new Image( $imageID );
            $uploader = new CustomUser( $image->UploadedBy );
            $html = <<<HTML
            <img class="img-circle" src="{$uploader->Image}" alt="Generic placeholder image" width="140" height="140">
            <h1>{$uploader->getFullName()}</h1>
HTML;
            return $html;
        }
        catch( RecordNotFoundException $ex )
        {
            return "Atvainoiet";
        }
    }

    public static function getCommentsForCommentID( $id )
    {
        if( is_int( $id ) || is_string( $id ) )
        {
            $comment = new Comment( $id );
        }
        else
        {
            $comment = $id;
        }

        $builder = "";

        $user = new CustomUser( $comment->PostedBy );
        $fullname = ucwords( $user->getFullName() );
        $subCommentBuilder = "";

        $comments = Comment::find( new Equals( 'InReplyTo', $comment->UniqueIdentifier ) );

        foreach( $comments as $c )
        {
            $subCommentBuilder .= self::getCommentsForCommentID( $c->CommentID );
        }

        $com = nl2br( $comment->Comment );
        $builder .= <<<HTML
                        <div class="comment-outer">
                            <div class="comment-background-underlay"></div>
                            <div class="comment-outer-image">
                                <img src="{$user->Image}">
                            </div>
                            <div class="comment-outer-text">
                                <div class="comment-outer-title">
                                    <span class="comment-inner-name">{$fullname}</span><span class="comment-inner-date">{$comment->PostedAt}</span>
                                </div>
                                <div class="delete">
                                    X
                                </div>
                                <div class="comment-inner-text">{$com}</div>
                                <a href="#" comId="{$comment->UniqueIdentifier}" class="comment-reply">Atbildēt</a>
                            </div>
                            <div class="__clear-floats"></div>
                            {$subCommentBuilder}
                         </div>
                         <div class="__clear-floats"></div>
HTML;

        return $builder;
    }


}