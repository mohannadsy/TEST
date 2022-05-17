<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;


class UserController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('pdf.index', compact('users'));
    }

    public function Download()
    {
        $user = User::all();
        $pdf = PDF::loadView('pdf.pdf', compact('user'));
        // $pdf = PDF::loadHTML('<h1> طباعة باللغة العربية   </h1>');
        return $pdf->download('document.pdf');
        
    }
}
