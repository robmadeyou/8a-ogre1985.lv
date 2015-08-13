var bridge = function (presenterPath) {
    window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
    $( document ).ready( function()
    {

        $( '.image-panorama-prev').click(function ( event ) {

            $( '.image-panorama-images' ).animate( { 'margin-left': '+=100%' } );
            event.preventDefault();
            return false;
        });

        $( '.image-panorama-next').click(function ( event ) {

            $( '.image-panorama-images' ).animate( { 'margin-left': '-=100%' } );
            event.preventDefault();
            return false;
        })
    });
};

window.rhubarb.viewBridgeClasses.ImagePanoramaViewBridge = bridge;