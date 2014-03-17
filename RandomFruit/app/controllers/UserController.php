<?php
class UserController extends BaseController{
	public function loginAction(){
		if(Input::server("REQUEST_METHOD") == 'POST'){
			$validator = Validator::make(Input::all(), User::$loginRules);
			if($validator->passes()){
				if (Auth::attempt(array('username' => Input::get("username"), 'password' => Input::get("password")))){
					return Redirect::route("dash");	
				}

			}
			echo "username/password is incorrect";
		}
		return View::make('login');
	}
}
