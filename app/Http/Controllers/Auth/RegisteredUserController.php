<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class RegisteredUserController extends Controller
{
    public function index()
    {
//        $images = Image::latest()->get();
//        return Inertia::render('Image/Index', ['images' => $images]);
        $users=User::all();
        return $users;
    }

    public function index2()
    {
        return view('imageUpload');
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }
//    public function createImage()
//    {
//        return Inertia::render('Image/Create');
//    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //save photo in folder
        $file_extension=$request -> photo -> getClientOriginalExtension();
        $file_name =time().' .'.$file_extension;
        $path ='images/users';
        $request -> photo ->move($path,$file_name);


        $user = User::create([
            'photo' => $file_name ,
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);


        return redirect(RouteServiceProvider::HOME);


    }

    public function store2AfterCompress(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
//        $x = 1;
//        if ($request->file != "") {
//            $file = $request->file("photo");
//            $file_name = time() . '_' . $file->getClientOriginalExtension();
//            $img = \Image::make($file);
//            $img->save(\public_path($file_name), $x);
//            return back();
//        }
//        return back();
//    }


        $image = $request->file('photo');
        $imageName = time() . ' .' . $image->getClientOriginalExtension();

        $destinationPathThumbnail = public_path('/images/users');
        $img = Image::make($image->path());

        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail . '/' . $imageName);

        $destinationPath = public_path('/images/users');
        $image->move($destinationPath, $imageName);

        return back()
            ->with('success', 'Image Upload successful')
            ->with('imageName', $imageName);


    }


}
