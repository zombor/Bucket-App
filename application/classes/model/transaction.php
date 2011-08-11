<?php
/**
 * Model for Transaction Business Logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Transaction extends AutoModeler
{
	protected $_table_name = 'transactions';

	protected $_data = array(
		'id' => NULL,
		'date' => '',
		'amount' => '',
		'memo' => '',
		'cleared_status' => '',
		'payee' => '',
		'category_id' => '',
		'account_id' => '',
	);
}