<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api extends Controller_Master	 {

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
		$passenger_origin = $loc[0];
		$passenger_destination = $loc[1];
		$date_trip = $date[0];
		$date_return = $date[1];
		$from = ORM::factory('Airports',$passenger_origin)->as_array();
		$to = ORM::factory('Airports',$passenger_destination)->as_array();
		// PLANNING TRIP
		$schedule_trip = ORM::factory('Schedules')->where('origin_id','=',$passenger_origin)
							->where('destination_id','=',$passenger_destination)
	    					->where('date', '=', date('Y-m-d', strtotime($date_trip)))
							->find_all();
		// PLANNING RETURN
		$schedule_return = ORM::factory('Schedules')->where('origin_id','=',$passenger_destination)
							->where('destination_id','=',$passenger_origin)
	    					->where('date', '=', date('Y-m-d', strtotime($date_return)))
							->find_all();
		//MAKE LIST AIRLINES FOR PLANNING TRIP
		$list_airlines_trip = [];
		foreach ($schedule_trip->as_array() as $key => $value) {
			$list_airlines_trip[] =['id'=>$value->airlines_id,'name'=>$value->airlines->name];
		}
		//MAKE LIST AIRLINES FOR PLANNING RETURN
		$list_airlines_return = [];
		foreach ($schedule_return->as_array() as $key => $value) {
			$list_airlines_return[] =['id'=>$value->airlines_id,'name'=>$value->airlines->name];
		}
		//MERGE ALL AIR LINES
		$list_airlines = $this->arrayUnique(array_merge($list_airlines_trip,$list_airlines_return));
		//PUSH SCHEDULE TO AIRLINES && CREATE PACKAGE
		$airlines = [];
		$trip_type = "single-trip";
		if ($date_return !="NA")
			$trip_type = 'round-trip';
		foreach ($list_airlines as $key => $airline) {

			$airlines[$key] = ['id'=>$airline['id'],'name'=>$airline['name'],'trip_type'=>$trip_type];
			$airlines[$key]['schedules'] = [];
			//PUSH SCHEDULE TRIP
			foreach ($schedule_trip->as_array() as $i => $trip) {
				if ( $airline['id'] == $trip->airlines_id)
					$airlines[$key]['schedules']['trip'][] = $trip->as_array();
			}
			//RETURN FALSE IF TRIP IS NULL
			if (isset($airlines[$key]['schedules']['trip']))
			{
				foreach ($schedule_return->as_array() as $j => $return) {
					if ( $airline['id'] == $return->airlines_id)
						$airlines[$key]['schedules']['return'][] = $return->as_array();
				}
			}
			// echo $airline['id'] . "--";
		}
			// print_r($airlines);
		//CLEAR AIRPLANES THAT HAVE NO SCHEDULES
		$clear_airlines = [];
		foreach ($airlines as $airline) {
			if(count($airline['schedules'])>0)
			{
			// echo $airline['name']  .":". count($airline['schedules']);
			$clear_airlines[] = $airline;
			}
		}

		$result = [
			'origin' => ['name'=>$from['name'] ,'city'=>$from['city'] ,'IATA'=>$from['IATA']],
			'destination' => ['name'=>$to['name'] ,'city'=>$to['city'] ,'IATA'=>$to['IATA']],
			'passenger' => ['dewasa'=>$passenger[0],'anak'=>$passenger[1],'balita'=>$passenger[2]],
			'date' => ['departure'=>$date[0],'arrival'=>$date[1]],
			'airlines' => $clear_airlines,
			];
		echo json_encode($result);

	}

	public function action_test_flight(){
		$result = [];
		$loc = explode('.',$this->params->ap);
		$date = explode('.',$this->params->dt);
		$passenger = explode('.',$this->params->ps);
		$passenger_origin = $loc[0];
		$passenger_destination = $loc[1];
		$date_trip = $date[0];
		$date_return = $date[1];
		$from = ORM::factory('Airports',$passenger_origin)->as_array();
		$to = ORM::factory('Airports',$passenger_destination)->as_array();
		// PLANNING TRIP
		$schedule_trip = ORM::factory('Schedules')->where('origin_id','=',$passenger_origin)
							->where('destination_id','=',$passenger_destination)
	    					->where('date', '=', date('Y-m-d', strtotime($date_trip)))
							->find_all();
		// PLANNING RETURN
		$schedule_return = ORM::factory('Schedules')->where('origin_id','=',$passenger_destination)
							->where('destination_id','=',$passenger_origin)
	    					->where('date', '=', date('Y-m-d', strtotime($date_return)))
							->find_all();
		//MAKE LIST AIRLINES FOR PLANNING TRIP
		$list_airlines_trip = [];
		foreach ($schedule_trip->as_array() as $key => $value) {
			$list_airlines_trip[] =['id'=>$value->airlines_id,'name'=>$value->airlines->name];
		}
		//MAKE LIST AIRLINES FOR PLANNING RETURN
		$list_airlines_return = [];
		foreach ($schedule_return->as_array() as $key => $value) {
			$list_airlines_return[] =['id'=>$value->airlines_id,'name'=>$value->airlines->name];
		}
		//MERGE ALL AIR LINES
		$list_airlines = $this->arrayUnique(array_merge($list_airlines_trip,$list_airlines_return));
		//PUSH SCHEDULE TO AIRLINES && CREATE PACKAGE
		$airlines = [];
		$trip_type = "single-trip";
		if ($date_return !="NA")
			$trip_type = 'round-trip';
		foreach ($list_airlines as $key => $airline) {

			$airlines[$key] = ['id'=>$airline['id'],'name'=>$airline['name'],'trip_type'=>$trip_type];
			$airlines[$key]['schedules'] = [];
			//PUSH SCHEDULE TRIP
			foreach ($schedule_trip->as_array() as $i => $trip) {
				if ( $airline['id'] == $trip->airlines_id)
					$airlines[$key]['schedules']['trip'][$i] = $trip->as_array();
			}
			//RETURN FALSE IF TRIP IS NULL
			if (isset($airlines[$key]['schedules']['trip']))
			{
				foreach ($schedule_return->as_array() as $j => $return) {
					if ( $airline['id'] == $return->airlines_id)
						$airlines[$key]['schedules']['return'][$j] = $return->as_array();
				}
			}
			// echo $airline['id'] . "--";
		}
			// print_r($airlines);
		//CLEAR AIRPLANES THAT HAVE NO SCHEDULES
		$clear_airlines = [];
		foreach ($airlines as $airline) {
			if(count($airline['schedules'])>0)
			{

			echo $airline['name']  .":". count($airline['schedules']);
			$clear_airlines[] = $airline;
			}
		}
		 // print_r($clear_airlines);
		echo json_encode($airlines);
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

	public function action_list_schedule(){
		$schedules = ORM::factory('Schedules');
		$count = $schedules->find_all()->count();
		$page = 1;

		$limit = 10;
		$last_page = ceil($count/$limit);
		if(isset($this->params->page))
			$page = $this->params->page;
		$offset = ($page-1)*$limit;

		$schedules = $schedules->limit($limit)->offset($offset)->order_by('id', 'desc')->find_all();
		$list_schedule = [];
		foreach ($schedules as $i=>$schedule) {
			$list_schedule[$i] = $schedule->as_array();
			$list_schedule[$i]['airlines'] = $schedule->airlines->name;
			$list_schedule[$i]['origin'] = $schedule->origin->name;
			$list_schedule[$i]['destination'] = $schedule->destination->name;
		}
		$output = [
			'page' => $page,
			'limit' => $limit,
			'last_page' => $last_page,
			'before' => $page == 1 ? false : $page - 1,
			'next' => $page == $last_page ? false : $page + 1,
			'count' => $count,
			'items' => $list_schedule,
			];
		echo json_encode($output);

	}


} // End Welcome

	    