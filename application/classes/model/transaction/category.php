<?php
/**
 * Model for Transaction Category Business Logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Transaction_Category extends AutoModeler_UUID
{
	protected $_table_name = 'transaction_categories';

	protected $_data = array(
		'id' => NULL,
		'name' => '',
	);
}