<?php

namespace Your\WebApp\Model;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrement;
use Rhubarb\Stem\Schema\Columns\DateTime;
use Rhubarb\Stem\Schema\Columns\Integer;
use Rhubarb\Stem\Schema\Columns\String;
use Rhubarb\Stem\Schema\ModelSchema;

class Discussion extends Model
{

    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new ModelSchema( 'tblDiscussion' );

        $schema->addColumn(
            new AutoIncrement( 'DiscussionID' ),
            new String( 'ImageSource', 200 ),
            new String( 'ImageThumbnailSource', 200 ),
            new Integer( 'UploadedBy' ),
            new DateTime( 'UploadedAt' ),
            new DateTime( 'LastUpdatedAt' )
            );

        return $schema;
    }

    /**
     * Override this to make changes just before the model is committed to the repository during a save operation
     */
    protected function beforeSave()
    {
        $this->LastUpdatedBy = new RhubarbDateTime();

        if( $this->isNewRecord() )
        {
            $this->UploadedAt = new RhubarbDateTime();
        }
        parent::beforeSave();
    }
}