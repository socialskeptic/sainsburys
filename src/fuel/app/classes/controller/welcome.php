<?php

namespace Controller;
use \Library;

/**
 * Class Welcome
 * @package Controller
 */
class Welcome extends Base\Rest
{
	/**
	 * The main index page for the application.
	 * @return mixed
	 */
	public function action_index()
	{
		$this->response(array('index'));
	}

	/**
	 * The 404 action for the application.
	 * @return mixed
	 */
	public function action_404()
	{
		$this->response(array('404'));
	}
}
