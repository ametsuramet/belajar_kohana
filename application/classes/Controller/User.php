<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Master {


	public function action_create()
	{


		// Enter a new user manually
        $user = ORM::factory('User');
        $user->username = $this->request->post('username');
        $user->password = $this->request->post('password');
        $user->email = $this->request->post('email');

        try{
            $user->save();
            $user->add('roles', ORM::factory('Role')->where('name', '=', $this->request->post('role'))->find());
        }
        catch(ORM_Validation_Exception $e){
            $errors = $e->errors();
        }

        if(isset($errors)){
            // $this->response->body(var_dump($errors));
            HTTP::redirect('/');
        }else{

            // Login with this user
            $success = Auth::instance()->login($this->request->post('username'),$this->request->post('password'));
            if ($success){
                HTTP::redirect('/');
            }else{
                HTTP::redirect('/login');

            }
        }

	}

	public function action_add(){
		


	}

} // End Welcome
