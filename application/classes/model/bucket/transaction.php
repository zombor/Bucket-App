<?php
/**
 * Model for Bucket Transaction Business Logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Bucket_Transaction extends AutoModeler_UUID
{
	protected $_table_name = 'bucket_transactions';

	protected $_data = array(
		'id' => NULL,
		'date' => '',
		'amount' => '',
		'from_bucket_id' => '',
		'to_bucket_id' => '',
	);

	/**
	 * Overload __get to support loading from and to buckets
	 *
	 * @return mixed
	 */
	public function __get($key)
	{
		if ('from_bucket' == $key OR 'to_bucket' == $key)
		{
			$column = $key.'_id';
			return new Model_Bucket($this->$column);
		}
		else
		{
			return parent::__get($key);
		}
	}
}