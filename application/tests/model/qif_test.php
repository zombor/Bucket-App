<?php
/**
 * Tests the qif business logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 *
 * @group Bucket_Core
 */
class Model_Qif_Test extends PHPUnit_Framework_TestCase
{
	/**
	 * Tests that importing a qif file works
	 *
	 * @return null
	 */
	public function test_qif_import()
	{
		$data = Model_Qif::parse_file(Kohana::find_file('tests', 'data/test', 'qif'));

		$this->assertSame(4, count($data));
	}
}