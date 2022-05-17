<?php


namespace App\Traits;
use Illuminate\Http\Request;

trait  UserTrait
{
    function saveImage(Request $request)
    {
    
        $file_extension = $request->photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'images';
        $request->photo->move($path, $file_name);

        return $file_name;
        //  $file_name = '';

        // if($request->hasFile('photo')){
        //     $file_name = $request->file('photo')->store('photo' , 'Images/users');
        // }
        // return $file_name;

    }


}
