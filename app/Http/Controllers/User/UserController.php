<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response(['message' => 'Invalid Login'], 401);
        } else {
            $token = $user->createToken('loginToken')->plainTextToken;
            $response = ['user' => $user, 'token' => $token,];
            ActivityLog::create([
                'user_id' => $user->id,
                'operation_name' => 'user ' . $user->name . ' login',
                'table' => 'users',
                'table_id' => $user->id,
            ]);
            return response()->json(['Login User' => $response], 200);
        }
    }


    public function register(Request $request)
    {

        if (Auth::user()->hasPermissionTo('store-user')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required | email | unique:users,email,',
                'password' => 'required|string',
            ]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            ActivityLog::create([
                'operation_name' => 'register user ' . $request->name,
                'user_id' => Auth::user()->id,
                'table' => 'users',
                'table_id' => $user->id,
            ]);

            $response = [
                'data' => $user,
                'message' => 'User Create Successfully',
            ];
            return response()->json($response, 200);        } else {
            return response()->json(['message' => ' You are Not allowed to Create user'], 401);
        }
    }

    public function getAllUsers()
    {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $data = User::orderBy('id', 'ASC')->paginate(5);
            ActivityLog::create([
                'user_id' => $user->id,
                'operation_name' => 'Get All Users',
                'table' => 'users',
                'table_id' => 0,
            ]);
            return response()->json(['users' => $data], 200);

        } else {
            return response()->json(['message' => 'not allowed to retrieve users'], 401);
        }
    }


    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('show-user') || $id == Auth::user()->id) {
            $user = User::find($id);
            ActivityLog::create([
                'operation_name' => 'show user with Id : ' . $id,
                'user_id' => Auth::user()->id,
                'table' => 'User',
                'table_id' => $id,

            ]);
            return response(['User' => $user]);
        } else {
            return response()->json(['message' => 'not allowed to store user'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $old_data = User::find($id)->toJson();

        if (Auth::user()->hasPermissionTo('update-user')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required | email | unique:users,email,' . $id,
                'password' => 'required|string',
            ]);
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = array_except($input, array('password'));
            }
            $user = User::find($id);
            $user->update($input);
            ActivityLog::create([
                'operation_name' => 'update user with Id :' . $id,
                'user_id' => Auth::user()->id,
                'table' => 'User',
                'table_id' => $id,
                'old_data' => $old_data,
            ]);
            return response()->json(['message' => 'User Updated Successfully'], 200);
        } else {
            return response()->json(['message' => 'not allowed to update user'], 401);
        }
    }

    public function destroy($id)
    {
        $old_data = User::find($id)->toJson();
        $user = Auth::user();
        if ($user->hasPermissionTo('delete-user')) {
            User::find($id)->delete();
            ActivityLog::create([
                'operation_name' => 'delete user with id : ' . $id,
                'user_id' => $user->id,
                'table' => 'users',
                'table_id' => $id,
                'old_data' => $old_data,
            ]);
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'You are not allowed to delete user'], 401);
        }
    }


    public function getUserPermissions($id)
    {
//        $old_data = Permission::get()->toJson();
        $user = Auth::user();
        if ($user->hasPermissionTo('show_permission')) {
            $userPermissions = User::find($id)->getAllPermissions();
            ActivityLog::create([
                'operation_name' => 'get user ' . $id . ' permissions',
                'table' => 'permissions',
                'user_id' => $user->id,
                'table_id' => $id,
            ]);
            return response()->json(['User-Permissions' => $userPermissions], 200);
        }
        return response()->json(['message' => 'You are not allowed to show permission']);
    }


    public function getUserRole($id)
    {
//        $old_data = Role::get()->toJson();
        $user = Auth::user();
        if ($user->hasPermissionTo('show-role')) {
            $userRole = User::with('roles')->find($id);
            ActivityLog::create([
                'operation_name' => 'get user' . $id . ' roles',
                'user_id' => $user->id,
                'table' => 'roles',
                'table_id' => $id,
            ]);
            return response()->json(['User-Roles' => $userRole], 200);
        }
        return response()->json(['message' => 'You are not allowed to show role']);
    }




    public function logout()
    {
        $user_id = auth()->user();
        auth()->user()->tokens()->delete();
        ActivityLog::create([
            'operation_name' => 'user' . Auth::user() . 'Logout',
            'user_id' => Auth::user()->id,
            'table' => 'users',
            'table_id' => $user_id,
        ]);
        return response(['message' => 'Logout Done successfully ']);
    }



}

