<?php

namespace Your\WebApp\Model;

use Rhubarb\Stem\Schema\SolutionSchema;

class DefaultSolutionSchema extends SolutionSchema
{
    public function __construct( $version = 2 )
    {
        parent::__construct( $version );

        $this->addModel( 'Image',      Image::class );
        $this->addModel( 'Comment',    Comment::class );
        $this->addModel( 'Gallery',    Gallery::class );
        $this->addModel( 'CustomUser', CustomUser::class );
    }
}