<?php

/**
 * The data access object for the memberships table
 */
class Membership extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'memberships';

    /**
     * Gets the relationship to the project
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function project(){
		return $this->hasOne('Project');
	}

    /**
     * Gets the relationship to the User
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function user(){
		return $this->hasOne('User');
	}

}
