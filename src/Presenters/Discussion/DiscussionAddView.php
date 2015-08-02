<?php

namespace Your\WebApp\Presenters\Discussion;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Presenters\Controls\FileUpload\DragAndDropFileUploadPresenter;
use Rhubarb\Patterns\Mvp\Crud\CrudView;
use Rhubarb\Scaffolds\Authentication\LoginProvider;
use Your\WebApp\Model\Discussion;

class DiscussionAddView extends CrudView
{
    /**
     * Called to allow a view to instantiate any sub presenters that may be needed.
     *
     * Called by the presenter when it is ready to receive any corresponding events.
     */
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

                $discussion = new Discussion();
                $discussion->UploadedBy = $user->UserID;
                $discussion->save();

                $discussion->ImageSource = '/static/images/uploaded/' . $discussion->UniqueIdentifier . '.' . $info[ 'extension' ];
                $discussion->ImageThumbnailSource = '/static/images/uploaded/' . $discussion->UniqueIdentifier . '.' . $info[ 'extension' ];

                if (!is_dir( 'static/images/uploaded/' )) {
                    mkdir( 'static/images/uploaded', 0777, true );
                }

                rename( $location,
                    'static/images/uploaded/' . $discussion->UniqueIdentifier . '.' . $info[ 'extension' ] );
                $discussion->save();
            }
        });

        $this->addPresenters(
            $upload
        );
    }

    protected function printViewContent()
    {
        $page = new HtmlPageSettings();
        $page->PageTitle = 'Pievienot bildi';

        $this->printFieldset( "", [
            "Image",
            $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
        ]);
    }
}