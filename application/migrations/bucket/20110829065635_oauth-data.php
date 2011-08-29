<?php defined('SYSPATH') or die('No direct script access.');/**
 * oauth2 data
 */
class Migration_Bucket_20110829065635 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$client_id = UUID::v4();
		$client_secret = UUID::v4();
		// Insert a client for website
		db::insert(
			'oauth2_clients',
			array('user_id', 'client_id', 'client_secret', 'redirect_uri')
		)->values(
			array(
				NULL, $client_id, $client_secret, ''
			)
		)->execute($db);

		Minion_CLI::write(
			'Your client_id is: '.$client_id.'. Keep this secret!', 'green'
		);

		// Get an access token for the website to use the api
		Model_OAuth2_Access_Token::$lifetime = 10 * 365 * 24 * 60 * 60; // 10 years
		$response = Request::factory('oauth2/token')->query(
			array(
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'grant_type' => OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS,
			)
		)->execute();

		$response = json_decode($response->body());

		Minion_CLI::write(
			'Your access_token is: '.$response->access_token.
			'. Keep this secret!', 'green'
		);
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		// We don't do anything, since we can't figure out the id of the client
	}
}
