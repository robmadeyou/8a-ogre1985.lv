<?php

namespace Your\WebApp\Model;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Rhubarb\Stem\Schema\Columns\AutoIncrement;
use Rhubarb\Stem\Schema\Columns\DateTime;
use Rhubarb\Stem\Schema\Columns\Integer;
use Rhubarb\Stem\Schema\Columns\String;
use Rhubarb\Stem\Schema\ModelSchema;

class Gallery extends Model
{

    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new ModelSchema( 'tblGallery' );
        $schema->addColumn(
            new AutoIncrement( 'GalleryID' ),
            new String( 'Title', 125 ),
            new Integer( 'DefaultImageID' ),
            new DateTime( 'CreatedAt' )
        );

        return $schema;
    }

    protected function beforeSave()
    {

        if( $this->isNewRecord() )
        {
            $this->CreatedAt = new DateTime( 'now' );
        }

        parent::beforeSave();
    }

    public function getDefaultImage()
    {
        //return $this->DefaultImageID;
        if( $this->DefaultImageID && $this->DefaultImageID !== 0 )
        {
                return (new Image( $this->DefaultImageID ))->Source;
        }
        return MySql::returnSingleValue( "SELECT Source FROM tblImage WHERE GalleryID = :GalleryID", [ "GalleryID" => $this->GalleryID ]);
    }
}