<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        //    return Inertia::render('Auth/Register');
    }


    public function show()
    {
        $users = User::all();
        return view('pdf.view', compact('users'));
    }


//public function getImage($prodcutImageID){
//    $productID=explode(".",$prodcutImageID);
//    $rendered_buffer= User::all()->find($productID[0])->photo;
//
//    $response = \Intervention\Image\Response::make($rendered_buffer);
//    $response->header('Content-Type', 'image/png');
//    $response->header('Cache-Control','max-age=2592000');
//    return $response;
//}

    public function store(Request $request)
    {

        if ($file = $request->file('photo')) {
            $path = '/users';
            $url = $this->file($file, $path, 300, 400);
        }


        // // store blob images ---------------1----------------
        // $file = $request->file('photo');
        // $imageType = $file->getClientOriginalExtension();
        
        // $image_resize = Image::make($file)->resize( null, 90, function ( $constraint ) {
        //                                                         $constraint->aspectRatio();
        //                                                     })->encode( $imageType );  
       // $user->photo = $image_resize;// in add user
        



        // // ----------------2----------------

        // $path = $request->file('photo')->getRealPath();    
        // $photo = file_get_contents($path);
        // $base64 = base64_encode($photo);
        // $user->photo = $base64;// in add user


        

        $user = new User();
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->photo = $url;
        
        if ($user->save()) {
            return back()->with('message', 'Product Created Successfully!');
        }
    }


    // // store blob images in database --------3-----------
    // $file = $request->file('image');
    // $contents = $file->openFile()->fread($file->getSize());

    // // or -------------4------
    // $request->image->storeAs('images', $imageName);  // storage/app/images/file.png

    // save blob images -----5-------
            // $path = $request->file('photo')->getRealPath();
            // $photo = file_get_contents($path);
            // $base64 = base64_encode($photo);
            // $user->photo = $base64; // in add user




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


