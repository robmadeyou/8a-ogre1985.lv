<?php

namespace Your\WebApp\Model;

use Rhubarb\Stem\Schema\SolutionSchema;

class DefaultSolutionSchema extends SolutionSchema
{
    public function __construct( $version = 1.2 )
    {
        parent::__construct( $version );

        $this->addModel( 'Discussion', Discussion::class );
    }
}