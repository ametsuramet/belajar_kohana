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
		if ($get_data)
		{
			if ($get_data->status->code == 0)
			{
				foreach ($get_data->cities as $key => $value) 
				{
					# code...
					$result[] = ['id'=>$value,'label'=>$value,'value'=>$value];
				}
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
		// print_r($get_data);die();
		if(($get_data) and is_object($get_data)){

			$result['output'] = $get_data;
			$result['output']->city = ["origin" => $asal, "destination" => $tujuan];
			$result['output']->weight = $berat;
			
		}
		elseif (!is_object($get_data)) 
		{
			$result["status"] = "Data error ......";
			
		}
		else
		{
			$result['output'] = $get_data;
			$result['output']->weight = $berat;
			// $result['output']->city = []
			// $result['output']->city['origin'] = $asal ;
			// $result['output']->city['destination'] = $tujuan ;
		}
		echo json_encode($result);

	}

	public function action_bandara()
	{
		$result = [];

	    $airports = new Model_Airports;
	    if(isset($this->params->country))
	    	$airports = $airports->where('country', '=', $this->params->country);
		else
	   		$airports = $airports->where('country', '=', "Indonesia");

	    $airports = $airports->where('city', 'like', "%".$this->params->term."%");
	    $airports->reset(FALSE); 
	    $total = $airports->count_all();
	    $airports = $airports->find_all();
	    $list_airports = [];

	    foreach ($airports as $i=>$airport) {
	    
	    	foreach ($airport->as_array() as $key => $value) {
	    		$list_airports[$i][$key] = $value;
	    	}
	    	$label = "$airport->city - $airport->name ($airport->IATA)";
	    	$result[$airport->id] = ['id'=>$airport->id,'label'=>$label,'value'=>$label,'data'=>$list_airports[$i]];
	    }
	    $list_airports = array_unique($list_airports, SORT_REGULAR);
		echo json_encode($result);
	}

	public function action_tiket(){
		// $this->response->headers('Content-Type', 'application/html; charset=utf-8');
		// $url = 'http://www.traveloka.com/fullsearch?ap=BDO.SUB&dt=04-11-2015.NA&ps=1.0.0';
		// $ch = curl_init();
		// $timeout = 5;
		// curl_setopt($ch,CURLOPT_URL,$url);
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		// curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		// $data = curl_exec($ch);
		// curl_close($ch);
		// $html = str_get_html($data);
		// $elem = $html->find('div[id=resultContainer]', 0);
		// var_dump( $elem );
		//resultContainer
		$html = file_get_html('http://www.traveloka.com/fullsearch?ap=BDO.SUB&dt=04-11-2015.NA&ps=1.0.0');

		echo $html ;die();
		foreach($html->find('body') as $element) 
		       echo $element->href . '<br>';
	}
	public function action_maskapai(){
		$result = [];

		$airlines = new Model_Airlines;
	    if(isset($this->params->country))
	    	$airlines = $airlines->where('country', '=', $this->params->country);
		else
	   		$airlines = $airlines->where('country', '=', "Indonesia");
   		$airlines = $airlines->where('active', '=', "Y");
	    $airlines = $airlines->where('name', 'like', "%".$this->params->term."%");

	    $airlines->reset(FALSE); 
	    $total = $airlines->count_all();
	    $airlines = $airlines->limit(10)->find_all();
	    $list_airlines = [];

	    foreach ($airlines as $i=>$airline) {
	    	foreach ($airline->as_array() as $key => $value) {
	    		$list_airlines[$i][$key] = $value;
	    	}
	    	$label = "$airline->name - $airline->country ($airline->IATA)";
	    	$result[$airline->id] = ['id'=>$airline->id,'label'=>$label,'value'=>$label,'data'=>$list_airlines[$i]];
	    }
	    // $list_airlines = array_unique($list_airlines, SORT_REGULAR);
		echo json_encode($result);
	}
	public function action_penerbangan(){
		$result = [];
		$loc = explode('.',$this->params->ap);
		$date = explode('.',$this->params->dt);
		$passenger = explode('.',$this->params->ps);

		$from = ORM::factory('Airports',$loc[0])->as_array();
		$to = ORM::factory('Airports',$loc[1])->as_array();


	    $schedules = new Model_Schedules;
    	$schedules = $schedules->where('origin_id', '=', $loc[0]);
    	$schedules = $schedules->where('destination_id', '=', $loc[1]);
    	$schedules = $schedules->where('date', '=', date('Y-m-d', strtotime($date[0])));
	    $schedules->reset(FALSE); 
	    $total_schedules = $schedules->count_all();
	    $schedules = $schedules->find_all();

	    // print_r($schedules);die();

	    $list_schedule = [];

	    foreach ($schedules as $i=>$schedule) {
	    	foreach ($schedule->as_array() as $key => $value) {
	    		$list_schedule[$i][$key] = $value;
	    	}
	    		$list_schedule[$i]['airlines'] = $schedule->airlines->as_array();
	    		$list_schedule[$i]['origin'] = $schedule->origin->as_array();
	    		$list_schedule[$i]['destination'] = $schedule->origin->as_array();
	    }
	

		$result = [
			'origin' => ['name'=>$from['name'] ,'city'=>$from['city'] ,'IATA'=>$from['IATA']],
			'destination' => ['name'=>$to['name'] ,'city'=>$to['city'] ,'IATA'=>$to['IATA']],
			'passenger' => ['dewasa'=>$passenger[0],'anak'=>$passenger[1],'balita'=>$passenger[2]],
			'schedule' => $list_schedule,
			];
		echo json_encode($result);

	}
	public function action_add_flight(){
		// print_r($this->params);die();

		$schedule = ORM::factory('Schedules');
		$schedule->airlines_id = $this->params->id_maskapai;
		$schedule->origin_id = $this->params->id_asal;
		$schedule->destination_id = $this->params->id_tujuan;
		$schedule->date = date('Y-m-d', strtotime($this->params->tgl_berangkat));
		$schedule->departure = $this->params->berangkat;
		$schedule->arrival = $this->params->tiba;
		$schedule->description = $this->params->description;
		$schedule->price_adult = $this->params->dewasa;
		$schedule->price_children = $this->params->anak;
		$schedule->price_toddler = $this->params->balita;



		if($schedule->save())
			echo json_encode(['status'=>'ok']);
		// print_r($schedule);
	} 

} // End Welcome

	    