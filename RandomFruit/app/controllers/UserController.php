<?php
class UserController extends BaseController{
	public function loginAction(){
		$error_message = "";
		if(Input::server("REQUEST_METHOD") == 'POST'){
			$validator = Validator::make(Input::all(), User::$loginRules);
			if($validator->passes()){
				if (Auth::attempt(array('username' => Input::get("username"), 'password' => Input::get("password")))){
					return Redirect::route("dash");	
				}

			}
			$error_message = "username/password is incorrect";
		}
		return View::make('login')->with('error_message', $error_message);
	}

	public function logout(){
		$error_message = "";
		if(Auth::check()){
			$error_message = "User " . Auth::user()->username . " has been logged out.";
			Auth::logout();
		}
		else{
			$error_message = "Sorry, you must be logged in to log out.";
		}
		return View::make('login')->with('error_message', $error_message);

	}

	public function getRememberToken()
	{
		    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		    return 'remember_token';
	}

}
