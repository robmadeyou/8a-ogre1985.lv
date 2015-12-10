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
			drop:function()
			{
				alert( 'aaa' );
			},
			update: function( event, ui ){
				var ids = [];
				$( group ).children().each( function()
				{
					console.log( 'aaa' );
					var val = $( this ).attr( 'iiid' );
					ids.push( val );
				});

				self.raiseServerEvent( 'ChangeImageID', ids, function( data )
					{
						console.log( data )
					}
				);
			}
		} );

	$( '.delete-image' ).click( function()
	{
		var imgID = $( this ).parent().attr( 'iiid' );
		self.raiseServerEvent( 'DeleteImage', imgID, function( response )
		{
			if( response )
			{
				$( this ).parent().remove();
			}
		})
	});

};

window.rhubarb.viewBridgeClasses.GalleryAddViewBridge = bridge;