<?php
/**
 * Model for Transaction Business Logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Account extends AutoModeler_UUID
{
	protected $_table_name = 'accounts';

	protected $_data = array(
		'id' => NULL,
		'name' => '',
		'account_number' => '',
		'routing_number' => '',
	);

	/**
	 * Overload constructor to load by name
	 *
	 * @return null
	 */
	public function __construct($id = NULL)
	{
		if ( ! $id)
		{
			parent::__construct($id);
		}
		else
		{
			$this->load(
				db::select_array($this->fields())
				->where($this->_table_name.'.id', '=', $id)
				->or_where($this->_table_name.'.name', '=', $id)
			);
		}
	}

	/**
	 * Returns the balance for this account on a specific time.
	 * 
	 * @param int $date unix timestamp date to get balance
	 *
	 * @return float
	 */
	public function balance($date = NULL)
	{
		if (NULL === $date)
		{
			$date = time();
		}

		$total = db::select(db::expr('SUM(`transactions`.`amount`) as total'))
			->from($this->_table_name)
			->join(Model::factory('transaction')->get_table_name())
			->on(
				Model::factory('transaction')->get_table_name().'.account_id',
				'=',
				db::expr('"'.$this->id.'"')
			)
			->where('date', '<=', $date)
			->as_object()
			->execute()->current()->total;

		return $total;
	}
}