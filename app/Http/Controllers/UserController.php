<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\User;
use App\Traits\file;

class UserController extends Controller
{

    // use File;

    // public function index()
    // {
    //    return view('welcome');
    // }

    // public function store(Request $request){

    //         $user = new User();
    //         $user->name = $request->name;
    //         $user->password = $request->password;
    //         $user->email = $request->email;
    //         $user->image =$request->image;

    //         if($user->save()){
    //             return back()->with('message','User Created Successfully!');
    //         }
    //     }}

    use File;

    public function index()
    {
       return view('welcome');
    }



    public function store(Request $request){

       if( $file = $request->file('photo') ) {
             $path = '/users';
             $url = $this->file($file,$path,300,400);
         }

         $user = new User();
         $user->name = $request->name;
         $user->password = $request->password;
         $user->email = $request->email;
         $user->photo = $url;

         if($user->save()){
             return back()->with('message','Product Created Successfully!');
         }
    }

    // public function store(Request $request){

    //    if( $file = $request->file('image') ) {

    //          $path = 'public';
    //          $url = $this->file($file,$path,300,400);
    //      }

    //      $user = new User();
    //      $user->name = $request->name;
    //      $user->password = $request->password;
    //      $user->email = $request->email;
    //      $user->image = $url;

    //      if($user->save()){
    //          return back()->with('message','User Created Successfully!');
    //      }
    // }


}


