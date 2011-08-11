<?php
/**
 * Model for Transaction Business Logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Account extends AutoModeler
{
	protected $_table_name = 'accounts';

	protected $_data = array(
		'id' => NULL,
		'name' => '',
		'account_number' => '',
		'routing_number' => '',
	);
}