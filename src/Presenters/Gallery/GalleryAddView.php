<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\FileUpload\DragAndDropFileUploadPresenter;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Rhubarb\Scaffolds\Authentication\LoginProvider;
use Your\WebApp\Model\Image;

class GalleryAddView extends CrudView
{

    public static $createdImagesForGallery = [];

    public function createPresenters()
    {
        parent::createPresenters();

        $upload = new DragAndDropFileUploadPresenter( 'Image' );
        $upload->filters[] = '.jpg';
        $upload->filters[] = '.jpeg';
        $upload->filters[] = '.png';
        $upload->filters[] = '.gif';

        $upload->attachEventHandler( 'FileUploaded', function( $file, $location )
        {
            if( $file && $location ) {
                $user = LoginProvider::getLoggedInUser();

                $info = pathinfo( $file );

                $discussion = new Image();
                $discussion->UploadedBy = $user->UserID;
                $discussion->save();

                $discussion->Source = '/static/images/uploaded/' . $discussion->UniqueIdentifier . '.' . $info[ 'extension' ];

                if (!is_dir( 'static/images/uploaded/' )) {
                    mkdir( 'static/images/uploaded', 0777, true );
                }
                $discussion->save();

                rename( $location,
                    'static/images/uploaded/' . $discussion->UniqueIdentifier . '.' . $info[ 'extension' ] );

                self::$createdImagesForGallery[] = $discussion->ImageID;
            }
        });

        $this->addPresenters(
            $upload,
            "Title"
        );
    }

    protected function printViewContent()
    {
        $page = new HtmlPageSettings();
        $page->PageTitle = 'Pievienot bildi';

        $this->printFieldset( "", [
            "Bildes" => "Image",
            "Nosaukums" => "Title",
            $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
        ]);
    }

}