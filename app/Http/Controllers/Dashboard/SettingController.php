<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App;
use App\Setting;

class SettingController extends Controller
{
    public function set_lang()
    {
        switch (session()->get('lang')) {
            case 'en':
                $this->lang = "en";
                break;
            case 'ar':
                $this->lang = "ar";
                break;

            default:
                $this->lang = "en";
                break;
        }
        App::setlocale($this->lang);
    }

    public function index(Request $request)
    {
        self::set_lang();
        return view('dashboard.settings.settings', [
            'titleofpage' =>__('lang.settings'),
        ]);
    }

    public function store(Request $request)
    {
        self::set_lang();

        $validation = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }
        $settings=new Setting();
        $settings->key=$request["key"];
        $settings->value=$request["value"];
        $settings->save();

        $output['message'] = 'settings saved Successfully';
        $output['code'] = 200;
        $output['data'] = $settings;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getSettings(Request $request)
    {
        if (request()->is('api/*')) {
            $settings=Setting::get();
            if ($settings==null) {
                $output['message'] = 'No data entry';
                $output['code'] = 404;
                $output['data'] = $settings;
    
                return response()->json($output, 404, [], JSON_UNESCAPED_UNICODE);
            }
            
            foreach ($settings as $item) {
                // dd($item);
                $data[$item->key]=$item->value;
            }
            $output['data']=$data;
            $output['code'] = 200;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            self::set_lang();
            if ($request->start ==0) {
                $request['page']=1;
            } else {
                $request['page']= ($request->start / $request->length)+1;
            }

            $query_length = $request['length'];
            $settings=new Setting();
            if ($settings==null) {
                $output['message'] = 'No data entry';
                $output['code'] = 404;
                $output['data'] = $settings;
    
                return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
            }
            $columns=[
                "0"=>"code",
            ];
            $data=null;
            $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
            $dir=$request["order"][0]["dir"];
            if ($column!=null) {
                $data = $settings->
                orderBy($column, $dir);
            }else{
                $data = $settings->
                orderBy("updated_at", "DESC");
            }   
            if ($request["search"]["value"]  != null) {
                $data = $settings->
                    where("key", 'like', '%'.$request['search']["value"].'%')
                    ->orWhere("value", 'like', '%'.$request['search']["value"].'%');
                
            }
            $count=$data->count();
            $data=$data->paginate(intVal($query_length))->toArray();
            $data['recordsTotal']=  $count;
            $data['recordsFiltered']=  $count;

            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function editSettings(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'settings_id' => 'required',
            'value' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }
        $settings=Setting::find($request["settings_id"]);
        // dd($settings);
        if ($settings==null) {
            $output['message'] = 'settings id not found';
            $output['code'] = 404;
            $output['data'] = $settings;
        }
        $settings->value=$request["value"];
 
        $settings->save();

        $output['message'] = 'settings updated successfully';
        $output['code'] = 200;
        $output['data'] = $settings;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function deleteSettings(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'settings_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }
        $settings=Setting::find($request["settings_id"]);
        // dd($settings);
        if ($settings==null) {
            $output['message'] = 'settings id not found';
            $output['code'] = 404;
            $output['data'] = $settings;
        }
        $settings->delete();
 
        $output['message'] = 'settings deleted successfully';
        $output['code'] = 200;
        $output['data'] = $settings;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
