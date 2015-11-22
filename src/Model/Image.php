<?php

namespace Your\WebApp\Model;

use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\GreaterThan;
use Rhubarb\Stem\Filters\LessThan;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\MySql;
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
            new DateTime( 'LastUpdatedAt' ),
            new Integer( 'Order', 0 )
            );

        return $schema;
    }

    public function GetResizedImage( $size = 0 )
    {
        $ext = str_replace( '.', '', substr( $this->Source, -4 ) );
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

    public function moveOrder( $to )
    {
        if( $this->Order > $to )
        {
            foreach( Image::find( new GreaterThan( 'Order', $this->Order  ) ) as $image )
            {
                $image->Order--;
                $image->save();
            }
        }
        else if( $this->Order == $to )
        {
            return;
        }
        else
        {
            foreach( Image::find( new LessThan( 'Order', $this->Order ) ) as $image )
            {
                $image->Order++;
                $image->save();
            }
        }

        $this->Order = $to;
        $this->save();
    }

    public function getThumbnail()
    {
        return $this->GetResizedImage( 1 );
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

    protected function afterSave()
    {
        parent::afterSave();

        if( $this->Order == null && $this->GalleryID != 0 )
        {
            $this->Order =  intval( MySql::returnSingleValue( "SELECT tblImage.Order FROM tblImage WHERE GalleryID = " . intval( $this->GalleryID ) . " ORDER BY tblImage.Order DESC LIMIT 1" ) ) + 1;
            $this->save();
        }
    }

    public static function checkRecords( $oldVersion, $newVersion )
    {
        parent::checkRecords( $oldVersion, $newVersion );

        if( $newVersion == 2 )
        {
            foreach( Gallery::find() as $gallery )
            {
                $i = 0;
                foreach( Image::find( new Equals( 'GalleryID', $gallery->GalleryID ) ) as $image )
                {
                    $image->Order = $i++;
                    $image->save();
                }
            }
        }
    }
}