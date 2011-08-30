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
}