<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Model\Comment;
use Your\WebApp\Model\Image;
use Your\WebApp\Presenters\Gallery\GalleryAddPresenter;

class ImageCommentsPanorama extends ImagePanorama
{

    /**
     * @param $images Image[]
     * @param string $name
     */
    public function __construct($images, $name = "")
    {
        parent::__construct($images, $name);

        if( isset( $_GET[ 'a' ] ) )
        {
            GalleryAddPresenter::$imgpath = 'usrdata/' . $_COOKIE[ 'PHPSESSID' ] . '/';
            GalleryAddPresenter::parseFiles();
            GalleryAddPresenter::moveAndCreateImages( $_GET[ 'a' ] );
        }
    }

    protected function createView()
    {
        return new ImageCommentsPanoramaView( $this->imgs );
    }

    protected function configureView()
    {

        $this->view->attachEventHandler( 'PostComment', function( $commentText, $imageID, $commentID = 0 )
        {
            if( $commentText != "" )
            {
                $comment = new Comment();
                $comment->ImageID = $imageID;
                $comment->Comment = $commentText;
                $comment->InReplyTo = $commentID;
                $comment->PostedBy = CustomLoginProvider::getLoggedInUser()->UserID;
                $comment->save();
            }
        });

        $this->view->attachEventHandler( 'GetComments', function ( $imageID )
        {
            return ImageCommentsPanoramaView::getCommentsForImageID( $imageID, false );
        });

        return parent::configureView();
    }
}