<?php

namespace Your\WebApp\Model;


use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumText;
use Rhubarb\Stem\Schema\Columns\AutoIncrement;
use Rhubarb\Stem\Schema\Columns\DateTime;
use Rhubarb\Stem\Schema\Columns\Integer;
use Rhubarb\Stem\Schema\ModelSchema;

class Comment extends Model
{

    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new ModelSchema( 'tblComment' );

        $schema->addColumn(
            new AutoIncrement( 'CommentID' ),
            new Integer( 'ImageID' ),
            new MySqlMediumText( 'Comment' ),
            new Integer( 'PostedBy' ),
            new DateTime( 'PostedAt' ),
            new Integer( 'ForComment' ),
            new Integer( 'InReplyTo', 0 )
        );

        return $schema;
    }

    /**
     * Override this to make changes just before the model is committed to the repository during a save operation
     */
    protected function beforeSave()
    {
        if( $this->isNewRecord() )
        {
            $this->PostedAt = new \DateTime();
        }
        parent::beforeSave();
    }

    protected function getUserImage()
    {
        $user = new CustomUser( $this->PostedBy );
        return $user->Image;
    }
}