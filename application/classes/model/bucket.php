<?php
/**
 * Model for Transaction Category Business Logic. Glues together transactions
 * and bucket transactions
 * 
 * The basiscs of an envelope budgeting system:
 * 
 * Positive transactions are assigned to INCOME buckets.
 * Money moves between buckets from an INCOME bucket to an EXPENSE bucket.
 * Negative transactions are assigned to EXPENSE buckets.
 * 
 * Money can also move between EXPENSE buckets to re-assign money for spending.
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Bucket extends AutoModeler_UUID
{
	const INCOME  = 1;
	const EXPENSE = 2;

	protected $_table_name = 'buckets';

	protected $_data = array(
		'id' => NULL,
		'name' => '',
		'type_id' => Model_Bucket::INCOME,
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
	 * Returns the balance for this bucket on a specific time.
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

		// to get the total, we need the transaction total (negative),
		// plus the bucket total (positive)
		$transaction_total = -(db::select(db::expr('SUM(amount) as total'))
			->from(Model::factory('transaction')->get_table_name())
			->where('date', '<=', $date)
			->where('bucket_id', '=', $this->id)
			->as_object()
			->execute()->current()->total);

		$bucket_total = db::select(db::expr('SUM(amount) as total'))
			->from(Model::factory('bucket_transaction')->get_table_name())
			->where('date', '<=', $date)
			->as_object()
			->execute()->current()->total;

		return number_format($transaction_total+$bucket_total, 2);
	}
}