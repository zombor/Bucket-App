<?php
/**
 * Extend kostache to add custom methods
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
abstract class Kostache extends Kohana_Kostache
{
	public $oauth_client;

	/**
	 * Gets the application's base url
	 *
	 * @return string
	 */
	public function base()
	{
		return url::base('http');
	}

	/**
	 * Gets the application's secure url
	 *
	 * @return string
	 */
	public function base_secure()
	{
		return url::base('https');
	}

	/**
	 * Returns template html for js
	 *
	 * @return array
	 */
	public function templates()
	{
		return array(
			'app' => file_get_contents(Kohana::find_file('templates', 'home/index', 'mustache')),
			'transaction' => file_get_contents(Kohana::find_file('templates', 'transaction/transaction', 'mustache')),
		);
	}
}