<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Twitter extends Controller_Master {

	public function action_index()
	{


		$master = View::factory('master');
		$content = View::factory('twitter/index');
		$master->content = $content;

		$this->response->body($master);
	    

	}

} // End Welcome
