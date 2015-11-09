<?php

namespace Your\WebApp\UrlHandlers;

use Rhubarb\Crown\HttpHeaders;
use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;

class ImageUrlHandler extends ClassMappedUrlHandler
{
    public function generateResponseForRequest( $request = null )
    {
        HttpHeaders::setContentType( 'application/download' );
        return parent::generateResponseForRequest( $request );
    }
}