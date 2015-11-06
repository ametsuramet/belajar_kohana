<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dashboard extends Controller_Master {

	public function action_index()
	{


		$master = View::factory('master');
		$content = View::factory('welcome/index');
		$master->content = $content;

	    $content->sample = "sample";


	    // print_r($result);
		$this->response->body($master);
	    

	}

} // End Welcome
