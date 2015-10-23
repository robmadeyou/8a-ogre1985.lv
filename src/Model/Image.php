<?php

namespace Your\WebApp\Model;

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

    public function GetResizedImage( $size = 0 )
    {
        $ext = substr( $this->Source, -3 );
        $beginning = '/static/images/uploaded/x';
        switch( $size )
        {
            case 1:
                return "{$beginning}0{$this->UniqueIdentifier}.{$ext}";
            case 2:
                return "{$beginning}1{$this->UniqueIdentifier}.{$ext}";
            default:
                return $this->Source;
        }
    }

    protected function beforeSave()
    {
        $this->LastUpdatedBy = new \DateTime();

        if( $this->isNewRecord() )
        {
            $this->UploadedAt = new \DateTime();
        }
        parent::beforeSave();
    }
}