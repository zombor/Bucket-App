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
	protected $_oauth_client;

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

		$this->_oauth_client = OAuth2_Consumer::factory(
			'bucket', OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS
		);

		$this->view->oauth_client = $this->_oauth_client;
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