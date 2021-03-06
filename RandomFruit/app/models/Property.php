<?php

/**
*  A data field of a ticket. This is intended to be used to allow custom fields in tickets. Properties are not used in Random Fruit v1.
*/
class Property extends Eloquent {

	/**
	 * The database table used by the model.
	 * A Property is a field of a ticket.
	 *
	 * @var string
	 */
	protected $table = 'properties';

}
