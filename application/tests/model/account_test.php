<?php
/**
 * Tests the account business logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 *
 * @group Bucket_Core
 */
class Model_Account_Test extends PHPUnit_Framework_TestCase
{
	/**
	 * Tests that account balance works
	 *
	 * @return null
	 */
	public function test_balance()
	{
		$account = new Model_Account('Testing');

		if ( ! $account->loaded())
		{
			$account->name = 'Testing';
			$account->save();
		}

		for ($i = 0; $i < 10; $i++)
		{
			$trans = new Model_Transaction;
			$trans->amount = $i;
			$trans->account_id = $account->id;
			$trans->date = $i;
			$trans->save();
		}

		$this->assertSame('45.00', $account->balance());

		$this->assertSame('0.00', $account->balance(0));
		$this->assertSame('1.00', $account->balance(1));
		$this->assertSame('3.00', $account->balance(2));
		$this->assertSame('15.00', $account->balance(5));
	}
}