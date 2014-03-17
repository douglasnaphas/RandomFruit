<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	public static $defaultRoles = array(
		array(
			'name' => 'Leader',
			'create_tickets' => 1,
			'delete_tickets' => 1,
			'modify_tickets' => 1,
			'comment_tickets' => 1,
		),
		array(
			'name' => 'Support',
			'create_tickets' => 0,
			'delete_tickets' => 0,
			'modify_tickets' => 0,
			'comment_tickets' => 1,
		)
	);

	
	
	public static function create(array $data)
	{	
		$myModel = parent::create($data);
		foreach(self::$defaultRoles as $role){
			$role['project_id'] = $myModel->id;
			Role::create($role);
		}
		return $myModel;
	}
	
	public static function roles(){
		return $this->hasMany('Role');
	}

	public static function users(){
		return $this->belongsToMany('User', 'memberships');
	} 
}
