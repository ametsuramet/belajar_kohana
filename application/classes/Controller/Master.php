<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Master extends Controller {

	// public $template = 'template';

	public function before()
	{
		parent::before();
		$this->base = URL::base();
		$this->ongkir_api_key = 'bd32fd950aac3aa842bbb12d34e3f40f';
		$this->params = (object) [];
		foreach ($_GET as $key => $value) {
			$this->params->$key = $value;
		}

	}

} // End Welcome
