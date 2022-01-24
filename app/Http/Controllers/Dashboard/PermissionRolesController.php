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

class PermissionRolesController extends Controller
{
    public function index()
    {
        $roles= Role::all();
        $permissions= Permission::all();
        $roles= Role::orderBy("id")->get();
       
        return view('dashboard.permission_roles.permission_roles', [
            'titleofpage'=>__('lang.permission_roles'),
            'roles'=>$roles,
            'permissions'=>$permissions,
            
        ]);
    }
    public function getRoles(Request $request)
    {
        $roles = Role::select('id', 'name')->orderBy("id")->get();
        $data['roles'] = $roles;
        return $data;
    }
    public function all_permissions(Request $request)
    {
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }
        if ($request['search']['value'] != null) {
            $permissions = DB::table('permissions')
            ->where('name', 'like', '%'.$request['search']['value'].'%');
            $count= $permissions->count();
            $permissions= $permissions->paginate($request->length);
        } else {
            $permissions = DB::table('permissions');
            $count= $permissions->count();
            $permissions= $permissions->paginate(intVal($request->length));
        }
        $roles_table = Role::orderBy("id")->get();
        $roles = [];
        $all_permissions = [];
        foreach ($roles_table as $role) {
            $roles[$role->id] = $role['name'];
        }
        foreach ($permissions as $permission) {
            $data = [];
            $data['id'] = (string)($permission['_id']);
            $data['permission_name'] = $permission['name'];
            $data['gaurd_name'] = $permission['guard_name'];
            $rolesbbb= Role::orderBy("_id")->get();
            // dd( $rolesbbb);
            foreach ($roles_table as $role) {
                $rolehasperm=DB::table('role_has_permissions')
                ->where('permission_id', $permission['_id'])
                ->where('role_id', $role['_id'])
                ->first();
                $permission_name=$permission["name"];
                $role_id=(string)$role["_id"];
                if( $rolehasperm != null){
                    $d = "<div class='checkbox icheck'><label><input  type='checkbox' name='namehere' class='permission' id='permibbb$permission_name$role_id' data-role-id='$role_id' data-permission='$permission_name' onclick=\"assignRole('$role_id','$permission_name',0)\" checked></label></div>";
                }else{
                    $d = "<div class='checkbox icheck'><label><input  type='checkbox' name='namehere' class='permission' id='permibbb$permission_name$role_id' data-role-id='$role_id' data-permission='$permission_name' onclick=\"assignRole('$role_id','$permission_name',1)\"></label></div>";
                }
                $data[$role['name']] = $d;
            }
            $all_permissions[] = $data;
        }
        
        $output = [];
        $output['data'] = $all_permissions;
        $output["recordsTotal"] =  $count;
        $output["recordsFiltered"] = $count;
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function check_role($permission_id)
    {
        $data = [];
        $permission = DB::table('role_has_permissions')->get();
        foreach ($permission as $per) {
            $data[$per->permission_id][] = $per->role_id;
        }
        return $data;
    }

    public function givePermissionToRole(Request $request)
    {
        if (env('APP_DEMO', false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
        } else {
            $input = $request->all();
            $this->permissionRepository->givePermissionToRole($input);
        }
    }

    public function revokePermissionToRole(Request $request)
    {
        if (env('APP_DEMO', false)) {
            Flash::warning('This is only demo app you can\'t change this section ');
        } else {
            $input = Request::all();
            $this->permissionRepository->revokePermissionToRole($input);
        }
    }

    public function roleHasPermission(Request $request)
    {
        $input = Request::all();
        //dd($input);
        $result = $this->permissionRepository->roleHasPermission($input);
        return json_encode($result);
    }
}
