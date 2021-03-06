<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
*  A user the system. Users can access Random Fruit. They can be instructors, who have top-level privileges over all courses and projects in the whole instance of Random Fruit, or students, who are not admins and can access and edit tickets in projects to which their instructor has added them. "Instructor" means "admin."
*/
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
	*  Validate inputs.
	*/
	public static $validation_rules = array(
		'username' => 'sometimes|unique:users',
		'password' => 'sometimes',
		'email' => 'sometimes|email',
		'old-password' => 'sometimes',
		'new-password' => 'sometimes',
		'new-password-copy' => 'sometimes'
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
	
/**
*  Get the projects to which this user belongs.
*  @return array
*/
	public function projects()
	{
		return $this->belongsToMany('Project', 'memberships');
	}

/**
*  Get the tickets this user has created.
*  @return array
*/
	public function ticketsCreated()
	{
		return $this->hasMany('Ticket', 'creator_id');
	}

/**
*  Get the tickets owned by this user. "Tickets owned by me" means "tickets assigned to me."
*  @return array.
*/
	public function ticketsOwned()
	{
		return $this->hasMany('Ticket', 'owner_id');
	}

	/**
	 * Retrieves a user based on their unique user name.
	 *
	 * @param string $user_name The username to be queried for
	 * @return User User model with username == $user_name
	 */
	public static function fromUserName($user_name){
		return self::where('username', '=', $user_name)->first();
	}

	/**
	*  Get the remember token.
	*  @return string
	*/
	public function getRememberToken()
	{
		    return $this->remember_token;
	}

	/**
	*  Set the remember token.
	*  @param $value The value to which to set the remember token.
	*  @return void
	*/
	public function setRememberToken($value)
	{
		    $this->remember_token = $value;
	}

	/**
	*  Get the remember token name.
	*  @return string
	*/
	public function getRememberTokenName()
	{
		    return 'remember_token';
	}
}
