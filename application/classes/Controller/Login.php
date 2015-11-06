<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller {

	public function before(){
		parent::before();

	}

	public function action_index()
	{
	    
		if(Auth::instance()->logged_in()){
			HTTP::redirect("/dashboard"); 
        }
		$content = View::factory('login/index');

		$this->response->body($content);

	}

	public function action_create()
	{

		if (HTTP_Request::POST == $this->request->method())
		{
			// Attempt to login user

			$remember = array_key_exists('remember', $this->request->post()) ? (bool) $this->request->post('remember') : FALSE;
			$user = Auth::instance()->login($this->request->post('username'), $this->request->post('password'), $remember );

			// If successful, redirect user
			if ($user)
			{

				HTTP::redirect("/"); 

				// echo "sukses";
			}
			else
			{
				HTTP::redirect("/login"); 
			}
		}
	}

	public function action_logout(){

		Auth::instance()->logout();
				HTTP::redirect("/login"); 
	}

} // End Welcome
