<?php defined('SYSPATH') or die('No direct script access.');

class Model_Schedules extends ORM
{
    
	protected $_table_name = 'schedules';	


	protected $_belongs_to = array(
	    'airlines' => array(
	        'model'       => 'Airlines',
	        'foreign_key' => 'airlines_id',
	    ),
	    'origin' => array(
	        'model'       => 'Airports',
	        'foreign_key' => 'origin_id',
	    ),
	    'destination' => array(
	        'model'       => 'Airports',
	        'foreign_key' => 'destination_id',
	    ),
	);
}