<?php

namespace Your\WebApp\Model;

use Rhubarb\Scaffolds\Authentication\User;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnum;
use Rhubarb\Stem\Schema\Columns\Boolean;
use Rhubarb\Stem\Schema\Columns\String;
use Rhubarb\Stem\Schema\ModelSchema;

class CustomUser extends User
{
    protected function extendSchema(ModelSchema $schema)
    {
        parent::extendSchema($schema);

        $schema->addColumn(
            new Boolean( 'IsSuperuser' ),
            new String( 'Image', 150 ),
            new MySqlEnum( 'Gender', 'Female', [ 'Male', 'Female'  ] ),
            new String( 'PhoneNumber', 20 ),
            new Boolean( 'ShowDetails' )
        );
    }

    public function getImage()
    {
        return $this->modelData[ 'Image' ] == "" ? '/static/images/no-user.png' : $this->modelData[ 'Image' ];
    }
}