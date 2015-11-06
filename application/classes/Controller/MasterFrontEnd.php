<?php defined('SYSPATH') or die('No direct script access.');

class Controller_MasterFrontEnd extends Controller {

	// public $template = 'template';

	public function before()
	{
		parent::before();
		$this->base = URL::base();
		$this->ongkir_api_key = 'bd32fd950aac3aa842bbb12d34e3f40f';
		$this->params = (object) [];
		foreach ($_GET as $key => $value) {
			$this->params->$key = $value;
		}

	}

	function arrayUnique($array, $preserveKeys = false)  
	{  
	    // Unique Array for return  
	    $arrayRewrite = array();  
	    // Array with the md5 hashes  
	    $arrayHashes = array();  
	    foreach($array as $key => $item) {  
	        // Serialize the current element and create a md5 hash  
	        $hash = md5(serialize($item));  
	        // If the md5 didn't come up yet, add the element to  
	        // to arrayRewrite, otherwise drop it  
	        if (!isset($arrayHashes[$hash])) {  
	            // Save the current element hash  
	            $arrayHashes[$hash] = $hash;  
	            // Add element to the unique Array  
	            if ($preserveKeys) {  
	                $arrayRewrite[$key] = $item;  
	            } else {  
	                $arrayRewrite[] = $item;  
	            }  
	        }  
	    }  
	    return $arrayRewrite;  
	}  

}