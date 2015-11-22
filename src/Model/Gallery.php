<?php

namespace Your\WebApp\Model;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Rhubarb\Stem\Schema\Columns\AutoIncrement;
use Rhubarb\Stem\Schema\Columns\Boolean;
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
            new DateTime( 'CreatedAt' ),
            new Boolean( 'Published' ),
            new Integer( 'Order' )
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
        if( $this->DefaultImageID && $this->DefaultImageID !== 0 )
        {
            $id = $this->DefaultImageID;
        }
        else
        {
            $id = MySql::returnSingleValue( "SELECT ImageID FROM tblImage WHERE GalleryID = :GalleryID ORDER BY \"Order\" ASC", [ "GalleryID" => $this->GalleryID ]);
        }
        try
        {
            return (new Image( $id ))->GetResizedImage( 1 );
        }
        catch( RecordNotFoundException $ex )
        {
            return '/static/images/no-thumb.png';
        }
    }

    public static function checkRecords( $oldVersion, $newVersion )
    {
        if( $newVersion == 2 )
        {
            $i = 0;
            foreach( Gallery::find() as $gallery )
            {
                $gallery->Order = $i++;
                $gallery->save();
            }
        }
    }

    protected function beforeDelete()
    {
        parent::beforeDelete();

        foreach( Image::find( new Equals( 'GalleryID', $this->UniqueIdentifier ) ) as $image )
        {
            $image->delete();
        }
    }
}