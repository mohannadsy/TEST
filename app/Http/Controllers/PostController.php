<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;


class PostController extends Controller
{
    public function index(){
        $posts = Post::all();

        return inertia('Posts/Index' , compact('posts'));

    }
    public function createPDF() {
        // retreive all records from db
        $data = Post::all();
        // share data to view
        view()->share('post',$data);
        $pdf = PDF::loadView('pdf_view', $data);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}
