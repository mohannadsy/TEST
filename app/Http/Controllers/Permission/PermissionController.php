<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:role-create', ['only' => ['create','store']]);
//        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
//    }


    public function getPermissionRoles($id)
    {
//        $old_data = Permission::get()->toJson();
        if (Auth::user()->hasPermissionTo('show-role')) {
            $permissionRoles = Permission::with('roles')->find($id);
            ActivityLog::create([
                'operation_name' => 'show permission' . $id . 'roles',
                'table' => 'permission',
                'table_id' => $id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Permission-Roles' => $permissionRoles], 200);
        }
        return response()->json(['message' => 'you are not allowed to show role']);
    }


    public function getPermissionUsers($id)
    {
//        $old_data = Permission::get()->toJson();
        if (Auth::user()->hasPermissionTo('show-user')) {
//            $this->global_id = $id;
//            $permissionUsers = User::whereHas('permission', function ($query) {
//                $query->where('id', $this->global_id);
//            })->get();

            $permissionUsers = [];
            $users = DB::table("model_has_permissions")->where('permission_id', $id)->get();

            foreach ($users as $user) {
                $permissionUsers = User::find($user->model_id);
            }

            ActivityLog::create([
                'operation_name' => 'show permission ' . $id . 'users',
                'table' => 'permission',
                'table_id' => $id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Permission-Users' => $permissionUsers], 200);
        }
        return response()->json(['message' => 'you are not allowed to show users']);
    }


    public function assignPermissionsToUser($user_id, $permission_id)
    {
//        $old_data = User::get()->toJson();
        $user = User::find($user_id);
        $permission = Permission::find($permission_id);
        if ($user->hasPermissionTo($permission)) {
            return response()->json(['message' => 'User Already Have This Permission... ']);
        } else {
            $user->givePermissionTo($permission);
            $response = [
                'Permission' => $permission
            ];
            ActivityLog::create([
                'operation_name' => 'assign permission ' . $permission->name . ' to user ' . $user->name,
                'table' => 'users',
                'table_id' => $user_id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Response' => $response, 'message' => 'Permission Assigned Successfully... ']);
        }
    }


    public function revokePermissionFromUser($user_id, $permission_id)
    {
//        $old_data = User::get()->toJson();
        $user = User::find($user_id);
        $permission = Permission::find($permission_id);
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            ActivityLog::create([
                'operation_name' => 'remove permission ' . $permission->name . ' from user ' . $user->name,
                'table' => 'users',
                'table_id' => $user_id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['message' => 'Permission Removed Successfully']);
        }
        $response = [
            'User' => $user,
            'Permission' => $permission
        ];
        return response()->json(['message' => 'User does not  Have This Permission', 'Response' => $response]);

    }


    public function getUserPermissionsNames($id)
    {
//        $old_data = User::get()->toJson();
        if (Auth::user()->hasPermissionTo('show-permission')) {
            $user = User::find($id);
            $permissionNames = $user->getPermissionNames();
            ActivityLog::create([
                'operation_name' => 'get user ' . $id . 'permissions names',
                'table' => 'users',
                'table_id' => $id,
//                'old_data' => $old_data,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['Permissions' => $permissionNames], 200);
        } else {
            return response()->json(['message' => 'You are not allowed to show-permission', 401]);
        }


    }
}
