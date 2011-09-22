$(document).ready(function()
{
	// init our app
	window.app = BucketAppController.init({
		// etc, etc
	});

	// draw our main view
	$('body').append(app.view.render().el);
});