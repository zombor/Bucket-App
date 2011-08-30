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
			'client_id'     => 'ce1d16fb-6d1a-45ba-81a4-c745dcfedee9',
			'client_secret' => '548c0ba3-81a2-4ba4-9373-3db010878bb0',
			'authorize_uri' => url::base(true, true).'oauth2/authorize',
			'token_uri'     => url::base(true, true).'oauth2/token',
		),
	)
);