<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use Validator;

class TankController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function water_tank(){
        return view('waterTank');
    }
    
    public function excute(Request $request){
        $validator = Validator::make(
            $request->all(),[
                'water_flow_in'=>'required',
                'water_flow_out'=>'required',
                'water_tank_size'=>'required',
                'water_tank_max_level'=>'required',
                'daily_consumption_per_hour'=>'required',
                'last_hour_water_level_reading'=>'required',
                'current_water_level_reading'=>'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $response = []; 
        $squarelenth_of_tank = $request['water_tank_size'] / $request['water_tank_max_level'];

        // If water tank  level reading is above tank size and water meter flow is continous
        $conditions    = [];
        $conditions[]  =  ($request['current_water_level_reading'] > $request['water_tank_size']);
        $conditions[]  =  ($request['water_flow_in'] > 0);
        $response_data = 0;

        //send signal to water meter to close valve 
        //send SMS notification to user of potential tank flowter mulfuntion
        $response['water_level_condition'] = $this->comparison($conditions, $response_data);
        

        //if water flow out over an hour is more than daily per hr consumtion
        $conditions = [];
        $conditions[] = ($request['water_flow_out'] > $request['daily_consumption_per_hour']);
        $response_data = 1;
        //send notification SMS to user to check resident unit for potential leackage
        $response['consumption_condition'] = $this->comparison($conditions, $response_data);



        //If water flow in rate minus water flow out 
        //Plus water level reading is below the value of expected calculated water level 
        $last_hour_water_level_reading = $request['last_hour_water_level_reading'] * $squarelenth_of_tank;
        $expected_water_level = ($request['water_flow_in'] - $request['water_flow_out']) + $last_hour_water_level_reading;
        $current_water_level_reading = $squarelenth_of_tank * $request['current_water_level_reading'];
        
        //send signal to water meter to close valve
        //send SMS notification to user of potential tank leackage
        $conditions = [];
        $conditions[] = ( $expected_water_level > $current_water_level_reading);
        $response_data = 2;
        $response['expected_water_level_condition'] = $this->comparison($conditions, $response_data);
        

        //Machine learn the new hourly, daily, montly consumption 
        //use those figures to calcuate the new hourly , daily and monthly average consumption
        $response['daily_consumption_per_hour'] = number_format($this->avg(explode(',',$request['water_flow_out_daily_array'])), 2);
        $conditions[] = ( $request['water_flow_out'] > $response['daily_consumption_per_hour'] );
        $response["daily_consumption_per_hour"] = 3;
        $response['monthly_consumption_per_hour'] = number_format($this->avg(explode(',',$request['water_flow_out_monthly_array'])),2);
        $conditions[] = ( $response['daily_consumption_per_hour'] > $response['monthly_consumption_per_hour'] );
        $response["monthly_consumption_per_hour"] = 4;
        
        return response()->json($response, 200); 
    }

    public function avg($array){
        return array_sum($array)/count($array);
    }

    public function comparison($conditions, $response)
    {
        foreach($conditions as $condition){
            if(!$condition){
                return 0;
            }
        }
        return $response;
    }
}
