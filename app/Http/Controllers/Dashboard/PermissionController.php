<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App;
use DB;
use Illuminate\Support\Facades\Auth;

// use App\Repositories\PermissionRepository;

class PermissionController extends Controller
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

    public function index()
    {
        return view('dashboard.permissions.permissions', [
            'titleofpage'=>__('lang.permissions'),
        ]);
    }
    public function getPermissions(Request $request)
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
        $data=new Permission();
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        $query_length = $request['length'];


        if ($request["search"]["value"]  != null) {
            $data= $data->where("permissions.name", 'like', '%'.$request['search']["value"].'%');
        }
        if ($column!=null) {
            $data = $data->orderBy($column, $dir);
        } else {
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
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'permission_id'=>'required',
            
            
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }

        Permission::where('id', $request['permission_id'])->delete();

        $data['code']=200;
        $data['data']='ok';
        $data['message']='deleted';
    
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'permission_id'=>'required',
            'permission_name'=>'required',
            
            
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }

        Permission::where('id', $request['permission_id'])
                    ->update(['name'=>$request['permission_name']]);
        
        $data['code']=200;
        $data['data']='ok';
        $data['message']='updated';
    
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'permission_name'=>'required',
            
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
        }

        // $role=Permission::create([
        //     'name'=>$request['permission_name'],
        //     'guard_name'=>'web'
        // ]);
        $role=new Permission();
        $role->name=$request['permission_name'];
        $role->guard_name='web';
        $role->save();
        $data['code']=200;
        $data['data']='ok';
        $data['message']='updated';
    
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function givePermissionToRole(Request $request)
    {
        // if (env('APP_DEMO', false)) {
        //     Flash::warning('This is only demo app you can\'t change this section ');
        // } else {
        //     $input = $request->all();
        //     $this->permissionRepository->givePermissionToRole($input);
        // }
        $role = Role::where("_id", $request->roleId)->first();
        $permission = Permission::where("name", $request->permission)->first();
        // dd($role,$permission,$role->givePermissionTo($permission));
        
        $permission->assignRole($role);
        return 1;
    }

    public function revokePermissionToRole(Request $request)
    {
        $role = Role::where("id", $request->roleId)->first();
        $permission = Permission::where("name", $request->permission)->first();
        $role->revokePermissionTo($permission);
        $permission->removeRole($role);
        return 1;
    }
    public function testper(Request $request)
    {
        // Adding permissions to a user
        // Auth::user()->givePermissionTo('vendor.index');

        // Adding permissions via a role
        // Auth::user()->assignRole('admin');
        // dd(Auth::user());
        // dd(Auth::user()->can('vendor.index'));
    }
    public function get_user_role(Request $request)
    {
        // $user= User::whereId($request->user_id)->first();
        // $permissions = $user->getAllPermissions();
        // dd($permissions);
        $role= DB::table("model_has_roles")
            ->where("model_id",  $request->user_id)
            ->where("model_type", "App\Models\User")->first();
            // dd($role);
        if($role !== null){
            return $role->role_id;
        }
        return 0;
    }

}
