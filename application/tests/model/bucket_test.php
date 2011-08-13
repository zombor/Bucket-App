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
		$category = new Model_Bucket('Testing');

		if ( ! $category->loaded())
		{
			$category->name = 'Testing';
			$category->save();
		}

		for ($i = 0; $i < 10; $i++)
		{
			$trans = new Model_Transaction;
			$trans->amount = $i;
			$trans->bucket_id = $category->id;
			$trans->date = $i;
			$trans->save();
		}

		$this->assertSame('45.00', $category->balance());

		$this->assertSame('0.00', $category->balance(0));
		$this->assertSame('1.00', $category->balance(1));
		$this->assertSame('3.00', $category->balance(2));
		$this->assertSame('15.00', $category->balance(5));
	}
}