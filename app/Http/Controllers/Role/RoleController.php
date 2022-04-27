<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->hasPermissionTo('show-role')) {

            $roles = Role::orderBy('id', 'ASC')->paginate(5);

            ActivityLog::create([
                'operation_name' => 'get all roles',
                'operation_by' => $user->name,
                'user_id' => $user->id,
            ]);
            return response()->json(['roles' => $roles], 200);;
        }
        return response()->json(['Message' => 'You are not allowed to show role']);;
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user->hasPermissionTo('store-role')) {

            $roles = Role::create([
                'name' => $request->name,
            ]);
            ActivityLog::create([
                'operation_name' => 'create role' . $roles->name,
                'operation_by' => $user->name,
                'user_id' => $user->id,
            ]);
            return response()->json(['roles' => $roles, 'Message' => 'Role Created Successfully..'], 200);
        }
        return response()->json(['Message' => 'You are not allowed to create role']);
    }


    public function assignRoleToUser($role_id, $user_id)
    {
        $role = Role::find($role_id);
        $user = User::find($user_id);
        if (!$user->hasRole($role)) {
            $user->assignRole($role_id);
            ActivityLog::create([
                'operation_name' => 'Assign role ' . $role->name . ' to user ' . $user->id,
                'user_id' => Auth::user()->id,
                'table' => 'roles',
                'table_id' => $role->id,
            ]);
            $response = [
                'User' => $user,
                'Roles' => $role
            ];
            return response()->json(['Response' => $response, 'message' => 'Role Assigned Successfully']);
        } else
            return response()->json(['message' => 'user already have this role']);
    }


    public function removeRoleFromUser($role_id, $user_id)
    {
        $role = Role::find($role_id);
        $user = User::find($user_id);
        if (Auth::user()->hasPermissionTo('delete-role')) {
            if ($user->hasRole($role)) {
                $user->removeRole($role);
                ActivityLog::create([
                    'operation_name' => 'remove role' . $role->name . ' from user ' . $user->name,
                    'table' => 'roles',
                    'table_id' => $role->id,
                    'user_id' => Auth::user()->id,
                ]);
                $response = [
                    'User' => $user,
                ];
                return response()->json(['Response' => $response]);
            }
            return response()->json(['message' => 'user have not this role']);
        }
        return response()->json(['message' => 'You are noy allowed to delete role']);

    }


    public function showRolePermissions($role_id) // test with permissss....
    {
        if (Auth::user()->hasPermissionTo('show-permission')) {
            $rolePermissions = Role::find($role_id)->getAllPermissions();
            ActivityLog::create([
                'operation_name' => 'show role' . $role_id . 'permissions',
                'table' => 'roles',
                'table_id' => $role_id,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Role-Permissions' => $rolePermissions], 200);
        }
        return response()->json(['Message' => 'You are not allowed to show permissions']);
    }


    public function update(Request $request, $id)
    {
        if (Auth::user()->hasPermissionTo('update-role')) {
            $this->validate($request, [
                'name' => ' string',
                'permission' => 'array',
            ]);
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));

            ActivityLog::create([
                'operation_name' => 'update role ' . $id,
                'table' => 'roles',
                'table_id' => $id,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Message' => 'Role updated successfully']);
        } else {
            return response()->json(['Message' => 'You are not allowed to update role']);
        }
    }


    public function destroy($id)
    {
//        $old_data = Role::get()->toJson();
        if (Auth::user()->hasPermissionTo('delete-role')) {
            DB::table("roles")->where('id', $id)->delete();

            ActivityLog::create([
                'operation_name' => 'delete role' . $id,
                'table' => 'roles',
                'table_id' => $id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Message' => 'Role deleted successfully']);
        } else {
            return response()->json(['Message' => 'You are not allowed to delete role']);
        }
    }

    public function getRolePermissions($id)
    {
//        $old_data = Role::get()->toJson();
        if (Auth::user()->hasPermissionTo('show-permission')) {

            $rolePermissions = Role::with('permissions')->find($id);

            ActivityLog::create([
                'operation_name' => 'get role' . $id . 'permissions',
                'table' => 'roles',
                'table_id' => $id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Role-Permissions' => $rolePermissions], 200);
        } else {
            return response()->json(['Message' => 'You are not allowed to show permission']);
        }
    }

    public function getRoleUsers($id)
    {
//        $old_data = User::get()->toJson();
        $role = Role::find($id);
        if ($role) {
            $roleUser = [];
            $users = DB::table("model_has_roles")->where('role_id', $id)->get();
            foreach ($users as $user) {
                $roleUser = User::find($user->model_id);
            }
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'operation_name' => 'get role  ' . $id . 'users',
                'table' => 'users',
                'table_id' => $id,
//                'old_data' => $old_data,
            ]);
            return response()->json(['Role-Users' => $roleUser], 200);
        }
        return response()->json(['message' => 'Role not found'], 401);

    }


    //------soft delete-----//

    public function softdelete() // soft delete
    {
        Role::find(4)->Delete();
    }

    public function restore() // from recycle
    {
        Role::withTrashed()->find(4)->restore();
    }

    public function forcedelete() // soft delete
    {
        Role::find(4)->forceDelete();
    }


}
