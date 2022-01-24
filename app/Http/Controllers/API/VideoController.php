<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Video;
class VideoController extends Controller
{
    public function get_videos(Request $request){
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

            $videos = Video::where('lang_code', $request['lang_code'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $videos;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_video(Request $request){
        $validation= Validator::make($request->all(), [
            'name'=>'required',
            'title'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $video = new Video;
            $video->name = $request['name'] ;
            $video->title = $request['title'] ;
            $video->lang_code = 'ar' ;
            $video->save();

            $id = $video->id;
            
            $video->video_id = $id;
            $video->save();
            
            $video = new Video;
            $video->video_id = $id ;
            $video->name = $request['name'] ;
            $video->title = $request['title'] ;
            $video->lang_code = 'en' ;
            $video->save();

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

    public function edit_video(Request $request){
        $validation= Validator::make($request->all(), [
            'video_id'=>'required',
            'name'=>'required',
            'title'=>'required',
            'lang_code'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $video = Video::where('video_id', $request['video_id'])->where('lang_code', $request['lang_code'])->first();
            if($video){
                $video->name = $request['name'] ;
                $video->title = $request['title'] ;
                $video->save();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such video';
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

    public function delete_video(Request $request){
       $validation= Validator::make($request->all(), [
            'video_id'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $video = Video::where('video_id', $request['video_id'])->get();
            if(sizeof($video) > 0){
                $video->delete();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such video';
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
