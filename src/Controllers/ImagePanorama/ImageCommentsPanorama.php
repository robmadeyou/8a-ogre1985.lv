<?php

namespace Your\WebApp\Controllers\ImagePanorama;

use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Model\Comment;
use Your\WebApp\Model\Image;

class ImageCommentsPanorama extends ImagePanorama
{

    /**
     * @param $imageUrls Image[]
     * @param string $name
     */
    public function __construct($images, $name = "")
    {
        parent::__construct($images, $name);
    }

    protected function createView()
    {
        return new ImageCommentsPanoramaView( $this->imgs );
    }

    protected function configureView()
    {

        $this->view->attachEventHandler( 'PostComment', function( $commentText, $imageID )
        {
            if( $commentText != "" )
            {
                $comment = new Comment();
                $comment->ImageID = $imageID;
                $comment->Comment = $commentText;
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