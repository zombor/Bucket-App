<?php

Route::set('templates', 'template/<file>.mustache', array('file' => '.+'))->
	defaults(
		array(
			'controller' => 'template',
			'action' => 'index',
		)
	);