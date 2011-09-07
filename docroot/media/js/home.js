$(document).ready(function()
{
	// Hijack forms and use the api instead
	$('form').submit(function(e)
	{
		e.preventDefault;
		alert('hi');
		return false;
	});
});