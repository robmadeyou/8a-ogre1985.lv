<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;
use Your\WebApp\Layouts\PortalLayout;
use Your\WebApp\Model\Image;

class GalleryAddPresenter extends ModelFormPresenter
{
    public static $imgpath;
    public function __construct( $name = "" )
    {
        self::$imgpath = 'usrdata/' . $_COOKIE[ 'PHPSESSID' ] . '/';

        parent::__construct( $name );

        if( !empty( $_FILES ) )
        {
            if( !is_dir( self::$imgpath ))
            {
                mkdir( self::$imgpath, 777, true );
            }

            foreach( $_FILES as $file )
            {
                if( self::isFileImage( $file[ 'tmp_name' ]))
                {
                    rename( $file[ 'tmp_name' ], self::$imgpath . $file[ 'name' ] );
                }
            }
        }
    }

    protected function createView()
    {
        LayoutModule::setLayoutClassName( PortalLayout::class );
        return new GalleryAddView();
    }

    protected function saveRestModel()
    {

        $model = parent::saveRestModel();

        if( !self::isDirectoryEmpty( self::$imgpath ) )
        {
            foreach( scandir( self::$imgpath ) as $img )
            {
                if( !is_dir( $img ) )
                {
                    GalleryAddView::uploadImage( $img, self::$imgpath . $img );
                }
            }
        }

        foreach( GalleryAddView::$createdImagesForGallery as $id )
        {
            $image = new Image( $id );
            $image->GalleryID = $model->GalleryID;
            $image->save();
        }

        return $model;
    }

    protected function redirectAfterCancel()
    {
        throw new ForceResponseException( new RedirectResponse( '/portal/' ) );
    }

    public static function isDirectoryEmpty( $dir )
    {
        if ( !is_readable( $dir ) ) return null;
        $handle = opendir( $dir );
        while ( false !== ( $entry = readdir( $handle ) ) )
        {
            if ( $entry != "." && $entry != ".." )
            {
                return false;
            }
        }
        return true;
    }

    public static function isFileImage( $path )
    {
        $finfo = new \finfo( FILEINFO_MIME_TYPE );
        if ( false === $ext = array_search(
                $finfo->file( $path ),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
            return false;
        }
        return true;
    }

}