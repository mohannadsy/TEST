<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\User;
use App\Traits\file;

class UserController extends Controller
{ 
     
    // public function imgResize(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'imgFile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);
  
    //     $image = $request->file('imgFile');
    //     $input['imagename'] = time().'.'.$image->extension();
     
    //     $filePath = public_path('/thumbnails');
    //     $img = Image::make($image->path());
    //     $img->resize(110, 110, function ($const) {
    //         $const->aspectRatio();
    //     })->save($filePath.'/'.$input['imagename']);
   
    //     $filePath = public_path('/images');
    //     $image->move($filePath, $input['imagename']);
   
    //     return back()
    //         ->with('success','Image uploaded')
    //         ->with('fileName',$input['imagename']);
    // }

    
    use File;

    public function index()
    {
       return view('welcome');
    }
 
    public function store(Request $request){
 
       if( $file = $request->file('image') ) {
             $path = 'Images/users';
             $url = $this->file($file,$path,300,400);
         }
 
         $user = new User();
         $user->name = $request->name;
         $user->password = $request->password;
         $user->email = $request->email;
         $user->image = $url;
 
         if($user->save()){
             return back()->with('message','Product Created Successfully!');
         }
    }
}

        