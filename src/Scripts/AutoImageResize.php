<?php

include_once( '../Helpers/ImageResize.php' );

$dirs = [
    '../../static/images/uploaded/',
    '../../static/images/usrimgs/'
];

foreach( $dirs as $dir )
{
    $files = scandir( $dir );
    foreach( $files as $file )
    {
        if( !is_dir( $file ) )
        {
            \Your\WebApp\Helpers\ImageResize::resizeIntoMultipleFormats( $file, $dir );
        }
    }
}