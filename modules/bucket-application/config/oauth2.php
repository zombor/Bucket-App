<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Default config for the OAuth2 module
 *
 * @package   OAuth2
 * @category  Config
 * @author    Managed I.T.
 * @copyright (c) 2011 Managed I.T.
 * @license   https://github.com/managedit/kohana-oauth2/blob/master/LICENSE.md
 */
return array(
	'consumer' => array(
		// Common Redirect URI
		//'redirect_uri' => 'http://localhost/kohana/inbound',
		'bucket' => array(
			// Override Redirect URI per provider
			'redirect_uri'  => 'http://localhost/kohana/inbound/kohana',
			'grant_type'    => OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS,
			'client_id'     => 'd9cd5f18-8f67-4e20-9233-6752d1c5a8de',
			'client_secret' => '19914b43-321a-4d95-b976-ebc2d4c98037',
			'authorize_uri' => '/oauth2/authorize',
			'token_uri'     => '/oauth2/token',
		),
	)
);