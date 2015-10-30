<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api extends Controller_Master {

	public function before()
	{
		parent::before();
		$this->response->headers('Content-Type', 'application/json; charset=utf-8');
	}


	public function action_kota()
	{
		$result = [];
		if(!isset($_GET['term']))
		{
			$result["status"] = "Please insert search keyword";
		}else
		{
			$q = $_GET['term'];
			$rest = new REST_Ongkir(array(
		        'server' => 'http://api.ongkir.info/'
		    ));
	    
		    $get_data = $rest->post('city/list', array(
		        'query' 	=> $q, 
		        'type' 	=> 'origin',
		        'courier' 	=> 'jne',
		        'API-Key' 	=> $this->ongkir_api_key,
		        'format' => 'json'
		    ));
		}
		if ($get_data->status->code == 0)
		{
			foreach ($get_data->cities as $key => $value) 
			{
				# code...
				$result[] = ['id'=>$value,'label'=>$value,'value'=>$value];
			}
		}
	    echo json_encode($result);

	}

	public function action_ongkir()
	{
		$result = [];
		if(!isset($_GET['asal']) and !isset($_GET['tujuan']) and !isset($_GET['berat']))
		{
			$result["status"] = "Please insert search keyword";
		}else
		{
			$asal = $_GET['asal'];
			$tujuan = $_GET['tujuan'];
			$berat = $_GET['berat'];

			$rest = new REST_Ongkir(array(
		        'server' => 'http://api.ongkir.info/'
		    ));
	    
		    $get_data = $rest->post('cost/find', array(
		        'from' 	=> $asal, 
		        'to' 	=> $tujuan, 
		        'weight' 	=> $berat, 
		        'courier' 	=> 'jne',
		        'API-Key' 	=> $this->ongkir_api_key,
		        'format' => 'json'
		    ));
		}
		if(!json_decode($get_data)){

			$result["status"] = "Data error ......";
			
		}
		elseif ($get_data->status->code == 0)
		{
			$result['output'] = $get_data;
			$result['output']->weight = $berat;
		}
		else
		{
			$result['output'] = $get_data;
			$result['output']->city = ["origin" => $asal, "destination" => $tujuan];
			$result['output']->weight = $berat;
			// $result['output']->city = []
			// $result['output']->city['origin'] = $asal ;
			// $result['output']->city['destination'] = $tujuan ;
		}
		echo json_encode($result);

	}

} // End Welcome

	    