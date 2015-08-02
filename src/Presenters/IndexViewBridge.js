var bridge = function (presenterPath) {
	window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge.apply(this, arguments);
};

bridge.prototype = new window.rhubarb.viewBridgeClasses.JqueryHtmlViewBridge();
bridge.prototype.constructor = bridge;

bridge.prototype.attachEvents = function () {
	var name, password;
	var self = this;

	this.waitForPresenters( [ 'username', 'password' ], function( un, pass )
	{
		name = un;
		password = pass;
	});

	$( '#log-in' ).click( function( event )
	{
		var n = $( "#" +  name.presenterPath ).val();
		var p = $( "#" +  password.presenterPath ).val();

		self.raiseServerEvent( 'login', n, p, function( ev )
		{
			window.location.href = ev;
		});
		event.preventDefault();
		return false;
	})
};

window.rhubarb.viewBridgeClasses.IndexViewBridge = bridge;