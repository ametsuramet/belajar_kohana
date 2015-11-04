<?php defined('SYSPATH') or die('No direct script access.');

class Model_Airlines extends ORM
{

	protected $_table_name = 'airlines';	

	protected $_has_many = array(
	    'schedules' => array(
	        'model'       => 'Schedules',
	        'foreign_key' => 'airlines_id',
	    ),
	   
	);

	

	
}