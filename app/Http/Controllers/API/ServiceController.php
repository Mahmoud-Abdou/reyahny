<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Service;
class ServiceController extends Controller
{
    public function get_services(Request $request){
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

            $services = Service::where('lang_code', $request['lang_code'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $services;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_service(Request $request){
        $validation= Validator::make($request->all(), [
            'name'=>'required',
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $service = new Service;
            $service->name = $request['name'] ;
            $service->title = $request['title'] ;
            $service->lang_code = 'ar' ;
            $service->description = $request['description'] ;
            $service->image = $request['image'] ;
            $service->save();
            $id = $service->id;

            $service->service_id = $id;
            $service->save();
            
            $service = new Service;
            $service->service_id = $id ;
            $service->name = $request['name'] ;
            $service->title = $request['title'] ;
            $service->lang_code = 'en' ;
            $service->description = $request['description'] ;
            $service->image = $request['image'] ;
            $service->save();
            
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

    public function edit_service(Request $request){
        $validation= Validator::make($request->all(), [
            'service_id'=>'required',
            'name'=>'required',
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
            'lang_code'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $service = Service::where('service_id', $request['service_id'])->where('lang_code', $request['lang_code'])->first();
            if($service){
                $service->name = $request['name'] ;
                $service->title = $request['title'] ;
                $service->description = $request['description'] ;
                $service->image = $request['image'] ;
                $service->save();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such service';
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

    public function delete_service(Request $request){   
       $validation= Validator::make($request->all(), [
            'service_id'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $service = Service::where('service_id', $request['service_id'])->get();
            if(sizeof($service) > 0){
                $service->delete();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such service';
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
