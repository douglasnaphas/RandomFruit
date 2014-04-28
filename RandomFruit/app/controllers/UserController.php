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

	public function createUser(){
		$post_input = array(
			'email' => Input::get('email'),
			'username' => Input::get('username'),
			'password' => Hash::make(Input::get('password'))
		);

		$validator = Validator::make($post_input, User::$validation_rules);

		if($validator->passes()){
			try{
				$newUser = new User();
				$newUser->email = $post_input['email'];
				$newUser->username = $post_input['username'];
				$newUser->password = $post_input['password'];
				$newUser->save();
				return Response::json(array('status' => 'success', 'data' => $newUser->toArray()));
			}
			catch(Exception $e)
			{
				return Response::json(array('status' => 'fail', 'error' => $e->getMessage()));
			}

		}else{
			return Response::json(array('status' => 'success', 'messages' => $validator->messages()->toArray()));
		}

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

	public function changePassword()
	{

		//Check to make sure that old-password, new-password and new-password copy are not null
		$input_data = array(
			'old-password' => Input::get('old-password'),
			'new-password' => Input::get('new-password'),
			'new-password-copy' => Input::get('new-password-copy')
		);

		$validator = Validator::make($input_data, User::$validation_rules);

		if($validator->fails()){
			return Response::json(
				array(
					'status' => 'success',
					'messages' => $validator->getMessages()->toArray()
				)
			);
		}

		//Check to make sure both new-password values match
		if($input_data['new-password'] !== $input_data['new-password-copy']){
			// Return error
			return Response::json(
				array(
					'status' => 'fail',
					'messages' => array(
						'new-password-copy' => 'New Passwords must match'
					)
				)
			);
		}

		//Hash(old-password) must equal User->password
		if(!(Hash::check($input_data['old-password'], Auth::user()->password))){
			return Response::json(
				array(
					'status' => 'fail',
					'messages' => array(
						'old-password' => 'Current password was incorrect'
					)
				)
			);

		}


		//Change password

		try{
			$user = Auth::user();	
			$user->password = Hash::make($input_data['new-password']);
			$user->save();
			return Response::json(
				array(
					'status' => 'success',
					'data' => $user->getAuthPassword()
				)
			);
		}
		catch(Exception $e){
			return Response::json(
				array(
					'status' => 'error',
					'message' => 'The server was unable to process the password change',
					'data' => $e->getMessage()
				)
			);
		}
		
	}

}
