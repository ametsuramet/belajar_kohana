<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend extends Controller_MasterFrontEnd {

	public function action_index()
	{


		$master = View::factory('masterFrontend');

		$content = View::factory('frontend/index');
		$header = View::factory('frontend/header');

		$master->content = $content;
		$master->content->header = $header;

		$this->response->body($master);

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
	
} // End Welcome
