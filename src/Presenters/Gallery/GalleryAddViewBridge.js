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
};

window.rhubarb.viewBridgeClasses.GalleryAddViewBridge = bridge;