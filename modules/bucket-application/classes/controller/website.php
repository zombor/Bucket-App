<?php
/**
 * Base application controller
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
abstract class Controller_Website extends Controller
{
	protected $_api_token;

	public function before()
	{
		parent::before();

		$directory = $this->request->directory()
			? $this->request->directory().'_'
			: '';
		$view_name = 'View_'
			.$directory
			.$this->request->controller()
			.'_'.$this->request->action();

		if (
			Kohana::find_file(
				'classes', strtolower(str_replace('_', '/', $view_name))
			)
		)
		{
			$this->view = new $view_name;
		}

		$this->_api_token = Kohana::$config->load('bucket.oauth2-token');

		if ( ! $this->_api_token)
		{
			throw new Kohana_Exception(
				'You must set the api key for this application!'
			);
		}
	}

	public function after()
	{
		if (isset($this->view))
		{
			$this->view->errors = Session::instance()->get_once('flash_error');
			$this->view->flash_message = Session::instance()->get_once('flash_message');

			$this->response->body($this->view->render());
		}
	}
}