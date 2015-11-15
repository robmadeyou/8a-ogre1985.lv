<?php

namespace Your\WebApp\Presenters\Gallery;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\FileUpload\DragAndDropFileUploadPresenter;
use Rhubarb\Leaf\Views\WithJqueryViewBridgeTrait;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Your\WebApp\Helpers\ImageResize;
use Your\WebApp\LoginProviders\CustomLoginProvider;
use Your\WebApp\Model\Image;

class GalleryAddView extends CrudView
{

    public static $createdImagesForGallery = [];

    use WithJqueryViewBridgeTrait;

    public function createPresenters()
    {
        parent::createPresenters();

        $this->addPresenters(
            "Title"
        );

        $this->presenters[ 'Save' ]->addCssClassNames( [ 'btn', 'btn-primary' ] );
        $this->presenters[ 'Save' ]->setButtonText( 'Saglābat' );
        $this->presenters[ 'Cancel' ]->setButtonText( 'Atcelt' );
    }

    protected function printViewContent()
    {
        $page = new HtmlPageSettings();
        $page->PageTitle = 'Pievienot Galeriju';

        ?>
        <div class="__container">
            <div id="dropzone">
                <div action="/portal/gallery/add/" class="dropzone" id="demo-upload">
                    <div class="dz-message">Bildes paradisies šeit<br />
                    </div>
                </div>
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nosaukums</label>
                    <div class="col-sm-10">
                        <?= $this->presenters[ 'Title' ] ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="#" class="btn btn-default" id="addPicturesLink">Pievienot bilde(s)</a>
                    </div>
                </div>
            </form>
            <?= $this->presenters[ 'Save' ]; ?>
            <div class="__clear-floats"></div>
        </div>
        <?php
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

            ImageResize::resizeIntoMultipleFormats( $discussion->UniqueIdentifier . '.' . $info[ 'extension' ], 'static/images/uploaded/' );

            self::$createdImagesForGallery[] = $discussion->ImageID;
        }
    }

}