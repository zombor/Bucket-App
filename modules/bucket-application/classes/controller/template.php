<?php
/**
 * Controller to serve mustache templates
 *
 * @package    Bucket
 * @author     Jeremy Bush
 * @copyright  (c) 2011 Jeremy Bush
 * @license    http://github.com/zombor/Bucket-App/raw/master/LICENSE
 */
class Controller_Template extends Controller
{
	/**
	 * Displays the main screen of the app
	 *
	 * @return null
	 */
	public function action_index()
	{
		$file = $this->request->param('file');
		if ($path = Kohana::find_file('templates', $file, 'mustache'))
		{
			$this->response->send_file($path, NULL, array('inline' => TRUE));
			return;
		}

		throw new HTTP_Exception_404('File not found!');
	}
}