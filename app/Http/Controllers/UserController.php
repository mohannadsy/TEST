<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use PDF;
// use Mpdf\Mpdf;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
// use Elibyy\TCPDF\Facades\TCPDF;

// use niklasravnsborg\LaravelPdf\Facades\Pdf;
//
// use Barryvdh\DomPDF\Facade as PDF;   // true

//use Barryvdh\DomPDF\Facade\Pdf;
//use Illuminate\Support\Facades\App;
// require_once('tcpdf_include.php');

//use Barryvdh\DomPDF as PDF;
//use Barryvdh\DomPDF\PDF;
//use Barryvdh\DomPDF;


class UserController extends Controller
{
    //

    public function index()
    {

        $users = User::all();

        return view('pdf.index', compact('users'));
    }


public function download(){
    $user  = User::find(2);
    $pdf = PDF::loadView('pdf.pdf', compact('user'));
    $pdf = PDF::loadHTML('<h1> كلودااااا  </h1>');
    return $pdf->download('document.pdf');
}

    public function store(Request $request)
    {

        $user = new User([
            'name' => $request->get('name'),
            'password' => $request->get('password'),
            'email' => $request->get('email'),
        ]);

        $user->save();
        return redirect('/index');
    }

}
