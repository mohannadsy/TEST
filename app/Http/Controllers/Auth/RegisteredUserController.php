<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
// use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Traits\UserTrait;

class RegisteredUserController extends Controller
{
    use UserTrait;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');

        // return inertia('Auth/Register');

    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */


     public function showUsers()
     {
         $users = User::all();
         return view('show-users',compact('users'));
     }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'photo' => ['required','image','mimes:jpeg,jpg,png','max:2048']
        ]);
        
        $file_name = $this->saveImage($request->photo,'Images/users');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo'=>$file_name,
        ]);

        return view('auth.register',compact('user'));
        // return Inertia::render('Register.vue');

        // return inertia('Auth/Register',compact('user'));

    // function saveImage($photo, $folder)
    // {
    //     //save photo in folder
    //     $file_extension = $photo->getClientOriginalExtension();
    //     $file_name = time() . '.' . $file_extension;
    //     $path = $folder;
    //     $photo->move($path, $file_name);
    //     return $file_name;
    // }

     

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
