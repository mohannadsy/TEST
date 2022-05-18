<?php


namespace App\Traits;
use Illuminate\Http\Request;

trait  UserTrait
{
    function saveImage($photo, $folder)
    {
    
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
        // //  $file_name = '';

        // // if($request->hasFile('photo')){
        // //     $file_name = $request->file('photo')->store('photo' , 'Images/users');
        // // }
        // // return $file_name;







        // $path = public_path('Images/users');

        // if ( ! file_exists($path) ) {
        //     mkdir($path, 0777, true);
        // }

        // $file = $request->file('photo');
        // $file_name ='';
        // $file_name = uniqid() . '_' . trim($file->getClientOriginalName());
        
        // $this->photo = $file_name;
        // $this->save();
        
        // $file->move($path, $file_name);

        // return $file_name;

    }


}
