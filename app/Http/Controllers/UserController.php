<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use App\Models\User;
use App\Traits\file;

class UserController extends Controller
{

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

    public function store(Request $request)
    {

//-----------------------------------------------------------------------------------------
//         resize images  File trait
        if ($file = $request->file('photo')) {
            $path = '/users';
            $url = $this->file($file, $path, 300, 400);
        }
//-----------------------------------------------------------------------------------------
        // store $ resize blob images    - 1 -

        $file = $request->file('photo');
        $imageType = $file->getClientOriginalExtension();

        $image_resize = Image::make($file)->resize(null, 1, function ($constraint) { // - 1 => from 36 kb to 91 b
            $constraint->aspectRatio();
        })->encode($imageType);
//         $user->photo = $image_resize;
//-----------------------------------------------------------------------------------------
        // store blob images in database  - 2 -

        $path = $request->file('photo')->getRealPath();
        $photo = file_get_contents($path);
        $base64 = base64_encode($photo);
//       $user->photo = $base64;
//-----------------------------------------------------------------------------------------
        // store blob images in database  - 3 -

        $file = $request->file('photo');
        $contents = $file->openFile()->fread($file->getSize());
//-----------------------------------------------------------------------------------------
        // store blob images in database  - 4 -
        $path = $request->file('photo')->getRealPath();
        $photo = file_get_contents($path);
        $base64 = base64_encode($photo);
//       $user->photo = $base64;

//-----------------------------------------------------------------------------------------

//--------------------------save in database------------------------------------------------
        $user = new User();
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->photo = $url;// resize images --- trait
//        $user->photo = $image_resize;// - 1 -
//        $user->photo = $base64;// - 2 -
//        $user->photo = $contents;// - 3 -
//        $user->photo = $base64;// - 4 -


        if ($user->save()) {
            return back()->with('message', 'Product Created Successfully!');
        }
    }

// store blob images in database  - 5 -
//-----------------------------------------------------------------------------------------
//
//    public function getImage($prodcutImageID)
//    {
//        $productID = explode(".", $prodcutImageID);
//        $rendered_buffer = User::all()->find($productID[0])->photo;
//        $response = Response::make($rendered_buffer);
//        $response->header('Content-Type', 'image/png');
//        $response->header('Cache-Control', 'max-age=2592000');
//        return $response;
//    }

}


