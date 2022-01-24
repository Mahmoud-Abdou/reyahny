<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Group;
use App\GroupTranslate;

use Validator;
use DB;

class GroupController extends Controller
{
    public function set_lang()
    {
        switch (session()->get('lang')) {
            case 'en':
                $this->language_code = 1;
                $this->lang = "en";
                break;
            case 'ar':
                $this->language_code = 2;
                $this->lang = "ar";
                break;

            default:
                $this->language_code = 1;
                $this->lang = "en";
                break;
        }
        App::setlocale($this->lang);
    }

    public function groups_page()
    {
        self::set_lang();
        
        return view('dashboard.group', [
            'titleofpage' => __('lang.group'),
        ]);
    }
    public function get_groups()
    {
        self::set_lang();
        $limit = 10;
        $groups = Group::join('group_translates', 'group_translates.group_id', 'groups.id')
                        ->where('group_translates.language_code', $this->language_code)->paginate($limit);

        $output['message'] = '';
        $output['code'] = 200;
        $output['data'] = $groups;

        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);

    }
    public function add_group()
    {
        self::set_lang();
        $validation = Validator::make($request->all(), [
           'name' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $group = new Group;
        $group->save();
        $languages = Language::get();
        foreach($languages as $language){
            $group_translate = new GroupTranslates;
            $group_translate->name = $request['name'];
            $group_translate->group_id = $group->id;
            $group_translate->language_code = $language->language_code;
            $group_translate->save();
        }
        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] ="added succ";
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);

    }
    public function edit_group()
    {
        self::set_lang();
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'group_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $group = Group::where('id', $request['group_id'])->first();
        if($group == null){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] ="no such group";
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE); 
        }
        
        $group_translate = GroupTranslates::where('group_id', $request['group_id'])->where('language_code', $this->language_code)->first();
        
        if($group_translate == null){
            $group_translate = GroupTranslates::where('group_id', $request['group_id'])->first();
        }
        $group_translate->name = $request['title'];
        $group_translate->save();

        $output['message'] = false;
        $output['code'] = 200;
        $output['data'] ="edited succ";
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function delete_group()
    {
        self::set_lang();
        $validation = Validator::make($request->all(), [
            'group_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $group = Group::where('id', $request['group_id'])->first();
        if($group == null){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] ="no such group";
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE); 
        }
        $group_translate = GroupTranslates::where('group_id', $request['group_id'])->delete();
        $group->delete();

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] ="deleted succ";
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
}