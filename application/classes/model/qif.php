<?php
/**
 * Model for QIF business logic
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Model_Qif extends Model
{
	const CODE_START     = '!';
	const CODE_TYPE      = '!Type:Bank';

	const CODE_DELIMITER = '^';
	const CODE_DATE      = 'D';
	const CODE_AMOUNT    = 'T';
	const CODE_MEMO      = 'M';
	const CODE_CLEAR     = 'C';
	const CODE_NUMBER    = 'N';
	const CODE_PAYEE     = 'P';
	const CODE_ADDRESS   = 'A';
	const CODE_CATEGORY  = 'L';

	const CODE_SPLIT_CATEORY = 'S';
	const CODE_SPLIT_MEMO    = 'E';
	const CODE_SPLIT_AMOUNT  = '$';
	const CODE_SPLIT_PERCENT = '%';

	public static function parse_file($file)
	{
		$index = 0;
		$transactions = array();
		$lines = file($file);

		$account = null;

		foreach($lines as $l)
		{
			$l = trim($l);

			// Skip empties.
			if (empty($l))
			{
				continue;
			}

			$code = $l[0];
			$data = substr($l, 1);

			switch($code)
			{
				case Model_Qif::CODE_START:
					// Try and find the account
					$account = new Model_Account($data);

					// Make a new account if not found
					if ( ! $account->loaded())
					{
						$account->name = $data;
						$account->save();
					}

					$transactions[++$index] = new Model_Transaction;
					$transactions[$index]->account_id = $account->id;

					break;
				case Model_Qif::CODE_DELIMITER:
					$transactions[++$index] = new Model_Transaction;
					$transactions[$index]->account_id = $account->id;
					break;
				case Model_Qif::CODE_DATE:
					$transactions[$index]->date = strtotime($data);
					break;
				case Model_Qif::CODE_AMOUNT:
					$transactions[$index]->amount = number_format(
						floatval($data), 2
					);
					break;
				case Model_Qif::CODE_PAYEE:
					$transactions[$index]->payee = $data;
					break;
				case Model_Qif::CODE_MEMO:
					$transactions[$index]->memo = $data;
					break;
				case Model_Qif::CODE_CLEAR:
					$transactions[$index]->cleared_status = $data;
					break;
				case Model_Qif::CODE_CATEGORY:
					// Try and find a category
					$category = new Model_Transaction_Category($data);

					// If not found, create it
					if ( ! $category->loaded())
					{
						$category->name = $data;
						$category->save();
					}

					break;
			}
		}

		// There's an extra delimiter at the end, so get rid of the empty
		unset($transactions[count($transactions)]);

		return $transactions;
	}
}