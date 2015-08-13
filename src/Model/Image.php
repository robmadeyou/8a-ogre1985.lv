<?php

namespace Your\WebApp\Model;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrement;
use Rhubarb\Stem\Schema\Columns\DateTime;
use Rhubarb\Stem\Schema\Columns\Integer;
use Rhubarb\Stem\Schema\Columns\String;
use Rhubarb\Stem\Schema\ModelSchema;

class Image extends Model
{

    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new ModelSchema( 'tblImage' );

        $schema->addColumn(
            new AutoIncrement( 'ImageID' ),
            new Integer( 'GalleryID' ),
            new String( 'Source', 200 ),
            new String( 'Thumbnail', 200 ),
            new Integer( 'UploadedBy' ),
            new DateTime( 'UploadedAt' ),
            new DateTime( 'LastUpdatedAt' )
            );

        return $schema;
    }

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