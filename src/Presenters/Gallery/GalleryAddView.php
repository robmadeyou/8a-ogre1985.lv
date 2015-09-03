<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\FileUpload\DragAndDropFileUploadPresenter;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Model\Image;

class GalleryAddView extends CrudView
{

    public static $createdImagesForGallery = [];

    use WithJqueryViewBridgeTrait;

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
            self::uploadImage( $file, $location );
        });

        $this->addPresenters(
            $upload,
            "Title"
        );

        $this->presenters[ 'Save' ]->setButtonText( 'Saglabat' );
        $this->presenters[ 'Cancel' ]->setButtonText( 'Atcelt' );
    }

    protected function printViewContent()
    {
        $page = new HtmlPageSettings();
        $page->PageTitle = 'Pievienot Galeriju';

        ?>
        <div class="__container">
            <a href="#" id="addPicturesLink">Pievienot bilde(s)</a>
            <div id="dropzone">
                <div action="/portal/gallery/add/" class="dropzone" id="demo-upload">
                    <div class="dz-message">
                        Iemet, vai clikskini te lai pievienotu bildes.<br />
                    </div>
                </div>
            </div>
        </div>
        <?php

        print $this->presenters[ 'Save' ];
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

    public static function uploadImage( $file, $location )
    {
        if( $file && $location ) {
            $user = CustomLoginProvider::getLoggedInUser();

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
    }

}