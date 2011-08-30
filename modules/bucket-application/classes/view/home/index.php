<?php
/**
 * Home view class
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class View_Home_Index extends Kostache_Layout
{
	public $title = 'Bucket-App';

	/**
	 * Gets all accounts with their balance
	 *
	 * @return array
	 */
	public function accounts()
	{
		try
		{
			$request = Request::factory('api/accounts/balance');

			// Execute the request, via the client.
			$response = json_decode($this->oauth_client->execute($request));

			return $response->payload;
		}
		catch (OAuth2_Exception_InvalidGrant $e)
		{
			/**
			 * This means the request failed due to bad credentials.
			 */
		}
	}

	/**
	 * Gets all buckets with their balance
	 *
	 * @return array
	 */
	public function buckets()
	{
		try
		{
			$request = Request::factory('api/buckets/balance');

			// Execute the request, via the client.
			$response = json_decode($this->oauth_client->execute($request));

			return $response->payload;
		}
		catch (OAuth2_Exception_InvalidGrant $e)
		{
			/**
			 * This means the request failed due to bad credentials.
			 */
		}
	}

	/**
	 * Gets all transactions, grouped by account
	 *
	 * @return array
	 */
	public function transactions()
	{
		$output = array();

		$account_response = json_decode(
			$this->oauth_client->execute(Request::factory('api/accounts'))
		);

		foreach ($account_response->payload as $account)
		{
			$account_output = array('account_name' => $account->name);
			$transactions = json_decode(
				$this->oauth_client->execute(
					Request::factory(
						'api/transactions/account?account_id='.$account->id
					)
				)
			);

			$account_output['account_transactions'] = $transactions->payload;

			$output[] = $account_output;
		}

		return $output;
	}
}