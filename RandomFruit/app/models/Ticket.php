<?php


class Ticket extends Eloquent {

	/**
	 * @var string The database table used by the model.
	 */
	protected $table = 'tickets';

	/* Defines values that cannot be filled from array */
	protected $guarded = array('id', 'number');

	public function creator(){
		return $this->belongsTo('User', 'creator_id');
	}

	/**
	 * @var array Array of rules used to validate form input prior to submitting
	 */
	public static $validation_rules = array(
		'title' => 'sometimes|required|max:255',
		'creator_id' => 'sometimes|required',
		'project_id' => 'sometimes|required',
		'owner_id' => 'sometimes|required',
		'actual_hours' => 'numeric',
		'planned_hours' => 'numeric'
	);


	/**
	 * Defines the tickets relationship to it's owner.
	 * This allows use of the 'owner' attribute as if it were a User model.
	 *
	 * @example: $owner = $ticket->owner; echo $owner->username;
	 * 
	 */
	public function owner(){
		return $this->belongsTo('User', 'owner_id');
	} 

	/**
	 * Defines the tickets relationship to it's project
	 * @example $project = $ticket->owner; echo $project->title
	 * 
	 */
	public function project(){
		return $this->belongsTo('Project');
	}

	/**
	 * Generate the url to the ticket's home page
	 *
	 * @return string The url to the tickets home page
	 */
	public function getUrl(){
		return URL::to("project/" . $this->project->title . "/ticket/" . $this->id);
	}

	public function parsedDescription(){
		$purifier_config = HTMLPurifier_Config::createDefault();
		$parser = new \Michelf\MarkdownExtra;

		$purifier_config->set('Core.Encoding', 'UTF-8');
		$purifier_config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
		$purifier_config->set('Cache.DefinitionImpl', null);
		$purifier_config->set('HTML.Allowed', 'ol,ul,li, h1,h2,h3,h4,h5,h6,pre,code[class],a[href|title],blockquote[cite]');
		$purifier = new HTMLPurifier($purifier_config);
		return $purifier->purify($parser->transform($this->description));
	}

	public function comments(){
		return $this->hasMany('Comment');

	}

}
