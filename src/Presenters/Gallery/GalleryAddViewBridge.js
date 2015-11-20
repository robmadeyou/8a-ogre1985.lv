var bridge = function (presenterPath) {
	window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	$( '#addPicturesLink').click( function()
	{
		$( '.dropzone' ).click();
	});

	var group = $( '#image-orders' ).sortable( {
			group:'serialization',
			delay:0,
			onDrop: function( $item, container, _super )
			{
				var data = group.sortable("serialize").get();

				var jsonString = JSON.stringify(data, null, ' ');

				console.log( jsonString );
				_super($item, container);
			}
		} )

};

window.rhubarb.viewBridgeClasses.GalleryAddViewBridge = bridge;