<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Flight extends Controller_Master {

	public function action_index()
	{


		$master = View::factory('master');
		$content = View::factory('flight/index');
		$master->content = $content;

		$this->response->body($master);
	    

	}

	public function action_add(){
		$master = View::factory('master');
		$content = View::factory('flight/add');
		$master->content = $content;

		$this->response->body($master);

	}

} // End Welcome
