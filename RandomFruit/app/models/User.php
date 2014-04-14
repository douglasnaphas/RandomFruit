<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public static $loginRules = array(
		'username' => 'required',
		'password' => 'required'
	);

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	

	public function projects()
	{
		return $this->belongsToMany('Project', 'memberships');
	}

	public function tickets_created()
	{
		return $this->hasMany('Ticket', 'creator_id');
	}


	public function ticketsOwned()
	{
		return $this->hasMany('Ticket', 'owner_id');
	}

	/**
	 * Retrieves a user based on their unique user name
	 *
	 * @param string $user_name The username to be queried for
	 * @return User User model with username == $user_name
	 */
	public static function fromUserName($user_name){
		return self::where('username', '=', $user_name)->first();
	}

	public function comments(){
		return $this->hasMany('Comment');
	}
}
