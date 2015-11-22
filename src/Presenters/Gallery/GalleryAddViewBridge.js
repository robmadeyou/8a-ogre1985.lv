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
			group:'serialization',
			delay:0,
			change: function( event, ui ){
				var index = ui.placeholder.index();
				var image = $( event.toElement ).attr( 'iiid' );
				var list = group.sortable("serialize").get();
				console.log( list );
				self.raiseServerEvent( 'ChangeImageID', image, index );
			}
		} )

};

window.rhubarb.viewBridgeClasses.GalleryAddViewBridge = bridge;