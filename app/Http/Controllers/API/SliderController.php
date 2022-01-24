<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Slider;

class SliderController extends Controller
{
    public function get_sliders(Request $request){
        $validation= Validator::make($request->all(), [
            'lang_code'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        try{
            if(!isset($request['page_limit'])){
                $request['page_limit'] = 10;
            }

            $sliders = Slider::where('lang_code', $request['lang_code'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $sliders;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_slider(Request $request){
        $validation= Validator::make($request->all(), [
            'name'=>'required',
            'title'=>'required',
            'description'=>'required',
            'lang_code'=>'required',
            'image'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $slider = new Slider;
            $slider->name = $request['name'] ;
            $slider->title = $request['title'] ;
            $slider->description = $request['description'] ;
            $slider->lang_code = 'ar' ;
            $slider->image = $request['image'] ;
            $slider->save();
            $id = $slider->id;

            $slider->slider_id = $id;
            $slider->save();

            $slider = new Slider;
            $slider->slider_id = $id ;
            $slider->name = $request['name'] ;
            $slider->title = $request['title'] ;
            $slider->description = $request['description'] ;
            $slider->lang_code = 'en' ;
            $slider->image = $request['image'] ;
            $slider->save();


            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'Added Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function edit_slider(Request $request){
        $validation= Validator::make($request->all(), [
            'slider_id'=>'required',
            'name'=>'required',
            'title'=>'required',
            'description'=>'required',
            'lang_code'=>'required',
            'image'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $slider = Slider::where('slider_id', $request['slider_id'])->where('lang_code', $request['lang_code'])->first();
            if($slider){
                $slider->name = $request['name'] ;
                $slider->title = $request['title'] ;
                $slider->description = $request['description'];
                $slider->image = $request['image'] ;
                $slider->save();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such slider';
                return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
            }

            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'Edited Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function delete_slider(Request $request){
       $validation= Validator::make($request->all(), [
            'slider_id'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $slider = Slider::where('slider_id', $request['slider_id'])->get();
            if(sizeof($slider) > 0){
                $slider->delete();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such slider';
                return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
            }

            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'deleted Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    
}
