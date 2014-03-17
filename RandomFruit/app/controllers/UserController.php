<?php
class UserController extends BaseController{
	public function loginAction(){
		if(Input::has('username')){
			return Redirect::route("dash");
		}else{
			echo "you lose";
		}
		return View::make('login');
	}
}
