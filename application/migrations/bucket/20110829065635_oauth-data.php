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
			'client_id: '.$client_id, 'green'
		);
		Minion_CLI::write(
			'client_secret: '.$client_secret, 'green'
		);
		Minion_CLI::write(
			'You need to put these values into modules/bucket-application/config/oauth2.php!!!!', 'yellow'
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
