<?php
/**
 * Tests the transaction category business logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 *
 * @group Bucket_Core
 */
class Model_Bucket_Test extends PHPUnit_Framework_TestCase
{
	/**
	 * Tests that account balance works
	 *
	 * @return null
	 */
	public function test_balance()
	{
		$bucket = new Model_Bucket('Testing');

		if ( ! $bucket->loaded())
		{
			$bucket->name = 'Testing';
			$bucket->save();
		}

		for ($i = 0; $i < 10; $i++)
		{
			$trans = new Model_Transaction;
			$trans->amount = $i;
			$trans->bucket_id = $bucket->id;
			$trans->date = $i;
			$trans->save();
		}

		$this->assertSame(-45.00, $bucket->balance());

		$this->assertSame(0.00, $bucket->balance(0));
		$this->assertSame(-1.00, $bucket->balance(1));
		$this->assertSame(-3.00, $bucket->balance(2));
		$this->assertSame(-15.00, $bucket->balance(5));

		// Add money to the bucket
		$from_bucket = new Model_Bucket;
		$from_bucket->name = 'Temp';
		$from_bucket->save();

		$trans = new Model_Bucket_Transaction;
		$trans->amount = 10;
		$trans->date = time();
		$trans->from_bucket_id = $from_bucket->id;
		$trans->to_bucket_id = $bucket->id;
		$trans->save();

		// Oh noes, we are still overspent!
		$this->assertSame(-35.00, $bucket->balance());
	}
}