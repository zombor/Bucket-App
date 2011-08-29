<?php
/**
 * API class for accounts
 *
 * @package    Account
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Account-App/raw/master/LICENSE
 */
class Controller_API_Accounts extends Controller_API
{
	/**
	 * Gets a account
	 *
	 * GET /api/account/:id
	 * 
	 * @return null
	 */
	public function get()
	{
		$id = $this->request->param('id' , FALSE);

		$account = new Model_Account($id);

		if ( ! $account->loaded())
		{
			throw new HTTP_Exception_404('Account Not Found!');
		}

		$this->_response_payload = $account->as_array();
	}

	/**
	 * GET /api/accounts
	 *
	 * @return null
	 */
	public function get_collection()
	{
		$accounts = Model::factory('account')->load(NULL, NULL);

		$output = array();
		foreach ($accounts as $account)
		{
			$output[] = $account->as_array();
		}

		$this->_response_payload = $output;
	}

	/**
	 * GET /api/accounts/:id/balance/:param
	 *
	 * @return null
	 */
	public function get_balance()
	{
		$id = $this->request->param('id');
		$date = $this->request->param('param');

		$account = new Model_Account($id);

		if ( ! $account->loaded())
		{
			throw new HTTP_Exception_404('Bucket Not Found!');
		}

		$this->_response_payload = $account->balance($date);
	}

	/**
	 * POST /api/accounts
	 *
	 * @return null
	 */
	public function post_collection()
	{
		$account = new Model_Account;

		$account->set_fields(
			array(
				'name' => arr::get($this->_request_payload, 'name'),
				'account_number' => arr::get(
					$this->_request_payload, 'account_number'
				),
				'routing_number' => arr::get(
					$this->_request_payload, 'routing_number'
				),
			)
		);

		$account->save();

		$this->_response_payload = $account->as_array();
	}

	/**
	 * PUT /api/accounts/:id
	 *
	 * @return null
	 */
	public function put()
	{
		$account = new Model_Account($this->request->param('id'));

		if ( ! $account->loaded())
		{
			throw new HTTP_Exception_404('Account Not Found!');
		}

		$account->set_fields(
			array(
				'name' => arr::get($this->_request_payload, 'name'),
				'account_number' => arr::get(
					$this->_request_payload, 'account_number'
				),
				'routing_number' => arr::get(
					$this->_request_payload, 'routing_number'
				),
			)
		);

		$account->save();

		$this->_response_payload = $account->as_array();
	}

	/**
	 * DELETE /api/accounts/:id
	 *
	 * @return null
	 */
	public function delete()
	{
		$account = new Model_Account($this->request->param('id'));

		if ( ! $account->loaded())
		{
			throw new HTTP_Exception_404('Account Not Found!');
		}

		$account->delete();
	}

	/**
	 * DELETE /api/accounts
	 *
	 * @return null
	 */
	public function delete_collection()
	{
		$accounts = Model::factory('account')->load(NULL, NULL);

		foreach ($accounts as $account)
		{
			$account->delete();
		}
	}
}