<?php
/**
* AutoModeler Extension for providing UUID id keys
*
* @package    Bucket
* @author     Jeremy Bush
* @copyright  (c) 2011 Jeremy Bush
* @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
*/
class AutoModeler_UUID extends AutoModeler_ORM
{
	/**
	 * Overload save to assign a UUID as the id
	 *
	 * @param mixed $validation validation object to save with
	 *
	 * @return int
	 */
	public function save($validation = NULL)
	{
		if ( ! $this->id)
		{
			$this->id = UUID::v4();
		}

		return parent::save($validation);
	}
}
