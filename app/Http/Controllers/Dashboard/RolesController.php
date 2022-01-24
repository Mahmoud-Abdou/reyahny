<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\Models\User;
use Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\PermissionRepository;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
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

    public function PermissionsList()
    {
        self::set_lang();
    
    }
    public function CreatePermission()
    {

        self::set_lang();
    }
    public function RolesList()
    {
        // Auth::user()->assignRole(Role::first());
        // dd(Auth::user()->hasAnyRole(Role::all()));
        self::set_lang();
        $vendors=User::where('role','vendor')->select('id','name','phone')->get();
        return view('dashboard.roles.roles', [
            'titleofpage'=>__('lang.roles'),
            
        ]);
    }
    public function store(Request $request)
    {
        
        $validation = Validator::make($request->all(), [
            'role_name'=>'required',
            
            
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }

        $role=Role::create([
            'name'=>$request['role_name'],
            'guard_name'=>'web'
        ]);
        $data['code']=200;
        $data['data']='ok';
        $data['message']='updated';
    
        return response()->json($data,200,[],JSON_UNESCAPED_UNICODE);

    }

    public function getRoles(Request $request)
    {
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }
        $columns=[
            "0"=>"name",
            "1"=>"guard_name",
           
        ];
        $data=new Role();;
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        $query_length = $request['length'];
        // dd($query_length);

        if ($request["search"]["value"]  != null) {
            $data= $data->where("roles.name", 'like', '%'.$request['search']["value"].'%');
            
        }
        if ($column!=null) {
            $data = $data->orderBy($column, $dir);
        }else{
            $data = $data->orderBy("roles.updated_at", "DESC");
        } 
        $count=$data->count();
        $data=$data->paginate(intVal($query_length))->toArray();
        $data['recordsTotal']=  $count;
        $data['recordsFiltered']=  $count;

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);


    }

    public function destroy(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_id'=>'required',
            
            
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }

        Role::where('id',$request['role_id'])->delete();
        
        $data['code']=200;
        $data['data']='ok';
        $data['message']='deleted';
    
        return response()->json($data,200,[],JSON_UNESCAPED_UNICODE);

    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_id'=>'required',
            'role_name'=>'required',
            
            
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }

        $role=Role::where('id',$request['role_id'])
                    ->update(['name'=>$request['role_name']]);
        
        $data['code']=200;
        $data['data']='ok';
        $data['message']='updated';
    
        return response()->json($data,200,[],JSON_UNESCAPED_UNICODE);

    }

    
    public function CreateRole()
    {

        self::set_lang();
    }
   

}
