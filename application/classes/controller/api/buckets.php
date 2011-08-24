<?php
/**
 * API class for buckets
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Controller_API_Buckets extends Controller_API
{
	/**
	 * Gets a bucket
	 *
	 * GET /api/bucket/:id
	 * 
	 * @return null
	 */
	public function get()
	{
		$id = $this->request->param('id' , FALSE);

		$bucket = new Model_Bucket($id);

		if ( ! $bucket->loaded())
		{
			throw new HTTP_Exception_404('Bucket Not Found!');
		}

		$this->_response_payload = $bucket->as_array();
	}

	/**
	 * GET /api/buckets
	 *
	 * @return null
	 */
	public function get_collection()
	{
		$buckets = Model::factory('bucket')->load(NULL, NULL);

		$output = array();
		foreach ($buckets as $bucket)
		{
			$output[] = $bucket->as_array();
		}

		$this->_response_payload = $output;
	}

	/**
	 * POST /api/buckets
	 *
	 * @return null
	 */
	public function post_collection()
	{
		$bucket = new Model_Bucket;

		$bucket->set_fields(
			array(
				'name' => arr::get($this->_request_payload, 'name'),
				'type_id' => arr::get($this->_request_payload, 'type_id'),
			)
		);

		$bucket->save();

		$this->_response_payload = $bucket->as_array();
	}

	/**
	 * PUT /api/buckets/:id
	 *
	 * @return null
	 */
	public function put()
	{
		$bucket = new Model_Bucket($this->request->param('id'));

		if ( ! $bucket->loaded())
		{
			throw new HTTP_Exception_404('Bucket Not Found!');
		}

		$bucket->set_fields(
			array(
				'name' => arr::get($this->_request_payload, 'name'),
				'type_id' => arr::get($this->_request_payload, 'type_id'),
			)
		);

		$bucket->save();

		$this->_response_payload = $bucket->as_array();
	}

	/**
	 * DELETE /api/buckets/:id
	 *
	 * @return null
	 */
	public function delete()
	{
		$bucket = new Model_Bucket($this->request->param('id'));

		if ( ! $bucket->loaded())
		{
			throw new HTTP_Exception_404('Bucket Not Found!');
		}

		$bucket->delete();
	}

	/**
	 * DELETE /api/buckets
	 *
	 * @return null
	 */
	public function delete_collection()
	{
		$buckets = Model::factory('bucket')->load(NULL, NULL);

		foreach ($buckets as $bucket)
		{
			$bucket->delete();
		}
	}
}