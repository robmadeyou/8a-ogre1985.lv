var bridge = function (presenterPath) {
    window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    var max = parseInt( $( '#max-gallery-elements' ).html() );
    var current = 0;
    var mouseOver = false;
    var self = this;
    var selectedImageID = $( $( '.thumbnail-image' )[0] ).attr( 'imgID' );
    var comments = $( '.comments-bound');

    hookIntoReplyEvents();
    $( '.image-panorama').hover( function()
    {
        mouseOver = true;
    }, function()
    {
        mouseOver = false;
    });

    $( document ).ready( function()
    {

        $( '.image-panorama-prev').click(function ( event ) {
            slideLeft();
            event.preventDefault();
            return false;
        });

        $( '.image-panorama-next').click(function ( event ) {
            slideRight();
            event.preventDefault();
            return false;
        });

        if( window.location.hash && window.location.hash != "#0" )
        {
            current = parseInt( window.location.hash.replace( "#", "" ) );
            slideTo( current, 1000 );
            clearSelected( 'thumbnail-image' );
            var img = $( '#img' + current);
            img.addClass( 'selected' );
            selectedImageID = img.attr( 'imgID' );
            getComments();
        }
    });

    $( '.thumbnail-image' ).click( function( event )
    {
        clearSelected( 'thumbnail-image' );
        $( this ).addClass( 'selected' );
        selectedImageID = $( this ).attr( 'imgID' );
        var id = parseInt( $( this ).attr( 'thumb' ) );
	    current = id;
        slideTo( id );
	    getComments();
    });

    function getComments( id )
    {
        if( !id )
        {
            id = selectedImageID;
        }
        self.raiseServerEvent( 'GetComments', id, function( data )
        {
            comments.html( data );
           hookIntoReplyEvents();
        });
    }

    function hookIntoReplyEvents()
    {
        $( '.comment-reply' ).click( function( data )
        {
            $( this ).after( 'stiff' );

            data.preventDefault();
            return false;
        })
    }

    $( '#comment-input-submit').click( function( event )
    {
        var a = $( '#comment-input' );
        self.raiseServerEvent( 'PostComment', a.val(), selectedImageID, function( data )
        {
            a.val( '' );
            getComments();
        });
        event.preventDefault();
        return false;
    });

    function clearSelected( filterClass )
    {
        $( '.' + filterClass + ".selected" ).removeClass( 'selected' );
    }

    function slideRight()
    {
        if( current == max )
        {
            current = 0;
            $( '.image-panorama-images' ).finish().animate( { 'margin-left': '0%' } );
        }
        else
        {
            current++;
            $( '.image-panorama-images' ).finish().animate( { 'margin-left': '-=100%' } );
        }
        var image = $( '#img' + current );
        image.click();
    }

    function slideLeft()
    {
        if( current == 0 )
        {
            current = max;
            $( '.image-panorama-images' ).finish().animate( { 'margin-left': '-' + (max * 100) + '%' } );
        }
        else
        {
            current--;
            $( '.image-panorama-images' ).finish().animate( { 'margin-left': '+=100%' } );
        }
        var image = $( '#img' + current );
	    image.click();
    }

    function slideTo( index, speed )
    {
        $( '.image-panorama-images' ).animate( { 'margin-left': '-' + ( index * 100 ) +'%' }, speed );
    }

    //loopOver();
    function loopOver()
    {
        setTimeout( loopOver, 5000 );
        if( !mouseOver )
        {
            slideTo( Math.floor( Math.random() * max ), 1000 )
        }
    }
};

window.rhubarb.viewBridgeClasses.ImageCommentsPanoramaViewBridge = bridge;