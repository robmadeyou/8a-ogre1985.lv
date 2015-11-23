var bridge = function (presenterPath) {
	window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var self = this;
	$( '#addPicturesLink').click( function()
	{
		$( '.dropzone' ).click();
	});

	var group = $( '#image-orders' ).sortable( {
			key:'iiid',
			delay:0,
			change: function( event, ui ){
				var image = $( event.toElement ).attr( 'iiid' );
				var ids = [];
				$( group).children().each( function()
				{
					var val = $( this ).attr( 'iiid' );
					if( val == undefined )
					{
						val = image;
					}
					ids.push( val );
				});
				console.log( group.sortable( "toArray" ) );

				self.raiseServerEvent( 'ChangeImageID', image, function( data )
					{
						//console.log( data )
					}
				);
			}
		} )

};

window.rhubarb.viewBridgeClasses.GalleryAddViewBridge = bridge;