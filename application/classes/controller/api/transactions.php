<?php
/**
 * API class for transactions
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Controller_API_Transactions extends Controller_API
{
	/**
	 * Gets a transaction
	 *
	 * GET /api/transaction/:id
	 * 
	 * @return null
	 */
	public function get()
	{
		$id = $this->request->param('id' , FALSE);

		$transaction = new Model_Transaction($id);

		if ( ! $transaction->loaded())
		{
			throw new HTTP_Exception_404('Transaction Not Found!');
		}

		$this->_response_payload = $transaction->as_array();
	}

	/**
	 * GET /api/transactions
	 *
	 * @return null
	 */
	public function get_collection()
	{
		$transactions = Model::factory('transaction')->load(NULL, NULL);

		$output = array();
		foreach ($transactions as $transaction)
		{
			$output[] = $transaction->as_array();
		}

		$this->_response_payload = $output;
	}

	/**
	 * GET /api/transactions/account?account_id=<id>
	 *
	 * @return null
	 */
	public function get_account_collection()
	{
		$account_id = $this->request->query('account_id');

		if ( ! $account_id)
		{
			throw new Kohana_Exception('You must specify an account_id!');
		}

		$transactions = Model::factory('transaction')->load(
			db::select()->where('account_id', '=', $account_id),
			NULL
		);

		$output = array();
		foreach ($transactions as $transaction)
		{
			$output[] = $transaction->as_array();
		}

		$this->_response_payload = $output;
	}

	/**
	 * POST /api/transactions
	 *
	 * @return null
	 */
	public function post_collection()
	{
		$transaction = new Model_Transaction;

		$transaction->set_fields(
			array(
				'date' => arr::get($this->_request_payload, 'date'),
				'amount' => arr::get($this->_request_payload, 'amount'),
				'memo' => arr::get($this->_request_payload, 'memo'),
				'cleared_status' => arr::get(
					$this->_request_payload, 'cleared_status'
				),
				'payee' => arr::get($this->_request_payload, 'payee'),
				'bucket_id' => arr::get($this->_request_payload, 'bucket_id'),
				'account_id' => arr::get($this->_request_payload, 'account_id'),
			)
		);

		$transaction->save();

		$this->_response_payload = $transaction->as_array();
	}

	/**
	 * PUT /api/transactions/:id
	 *
	 * @return null
	 */
	public function put()
	{
		$transaction = new Model_Transaction($this->request->param('id'));

		if ( ! $transaction->loaded())
		{
			throw new HTTP_Exception_404('Transaction Not Found!');
		}

		$transaction->set_fields(
			array(
				'date' => arr::get($this->_request_payload, 'date'),
				'amount' => arr::get($this->_request_payload, 'amount'),
				'memo' => arr::get($this->_request_payload, 'memo'),
				'cleared_status' => arr::get(
					$this->_request_payload, 'cleared_status'
				),
				'payee' => arr::get($this->_request_payload, 'payee'),
				'bucket_id' => arr::get($this->_request_payload, 'bucket_id'),
				'account_id' => arr::get($this->_request_payload, 'account_id'),
			)
		);

		$transaction->save();

		$this->_response_payload = $transaction->as_array();
	}

	/**
	 * DELETE /api/transactions/:id
	 *
	 * @return null
	 */
	public function delete()
	{
		$transaction = new Model_Transaction($this->request->param('id'));

		if ( ! $transaction->loaded())
		{
			throw new HTTP_Exception_404('Transaction Not Found!');
		}

		$transaction->delete();
	}

	/**
	 * DELETE /api/transactions
	 *
	 * @return null
	 */
	public function delete_collection()
	{
		$transactions = Model::factory('transaction')->load(NULL, NULL);

		foreach ($transactions as $transaction)
		{
			$transaction->delete();
		}
	}
}