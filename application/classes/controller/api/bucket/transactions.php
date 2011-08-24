<?php
/**
 * API class for bucket_transactions
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Controller_API_Bucket_Transactions extends Controller_API
{
	/**
	 * Gets a bucket_transaction
	 *
	 * GET /api/bucket_transaction/:id
	 * 
	 * @return null
	 */
	public function get()
	{
		$id = $this->request->param('id' , FALSE);

		$bucket_transaction = new Model_Bucket_Transaction($id);

		if ( ! $bucket_transaction->loaded())
		{
			throw new HTTP_Exception_404('Bucket_Transaction Not Found!');
		}

		$this->_response_payload = $bucket_transaction->as_array();
	}

	/**
	 * GET /api/bucket_transactions
	 *
	 * @return null
	 */
	public function get_collection()
	{
		$bucket_transactions = Model::factory(
			'bucket_transaction'
		)->load(NULL, NULL);

		$output = array();
		foreach ($bucket_transactions as $bucket_transaction)
		{
			$output[] = $bucket_transaction->as_array();
		}

		$this->_response_payload = $output;
	}

	/**
	 * POST /api/bucket_transactions
	 *
	 * @return null
	 */
	public function post_collection()
	{
		$bucket_transaction = new Model_Bucket_Transaction;

		$bucket_transaction->set_fields(
			array(
				'date' => arr::get($this->_request_payload, 'date'),
				'amount' => arr::get($this->_request_payload, 'amount'),
				'from_bucket_id' => arr::get(
					$this->_request_payload, 'from_bucket_id'
				),
				'to_bucket_id' => arr::get(
					$this->_request_payload, 'to_bucket_id'
				),
			)
		);

		$bucket_transaction->save();

		$this->_response_payload = $bucket_transaction->as_array();
	}

	/**
	 * PUT /api/bucket_transactions/:id
	 *
	 * @return null
	 */
	public function put()
	{
		$bucket_transaction = new Model_Bucket_Transaction(
			$this->request->param('id')
		);

		if ( ! $bucket_transaction->loaded())
		{
			throw new HTTP_Exception_404('Bucket_Transaction Not Found!');
		}

		$bucket_transaction->set_fields(
			array(
				'date' => arr::get($this->_request_payload, 'date'),
				'amount' => arr::get($this->_request_payload, 'amount'),
				'from_bucket_id' => arr::get(
					$this->_request_payload, 'from_bucket_id'
				),
				'to_bucket_id' => arr::get(
					$this->_request_payload, 'to_bucket_id'
				),
			)
		);

		$bucket_transaction->save();

		$this->_response_payload = $bucket_transaction->as_array();
	}

	/**
	 * DELETE /api/bucket_transactions/:id
	 *
	 * @return null
	 */
	public function delete()
	{
		$bucket_transaction = new Model_Bucket_Transaction(
			$this->request->param('id')
		);

		if ( ! $bucket_transaction->loaded())
		{
			throw new HTTP_Exception_404('Bucket_Transaction Not Found!');
		}

		$bucket_transaction->delete();
	}

	/**
	 * DELETE /api/bucket_transactions
	 *
	 * @return null
	 */
	public function delete_collection()
	{
		$bucket_transactions = Model::factory('bucket_transaction')
			->load(NULL, NULL);

		foreach ($bucket_transactions as $bucket_transaction)
		{
			$bucket_transaction->delete();
		}
	}
}