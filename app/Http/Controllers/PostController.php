<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use PDF;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();

        return inertia('Posts/Index' , compact('posts'));

    }

//    public function generate_pdf()
//    {
//        $data = [
//            'foo' => 'bar'
//        ];
////        $pdf = PDF::loadView(this.$inertia.post('welcome', data));
//
//        $pdf = PDF::loadView('pdf.document', $data);
////        this.$inertia.post('/article', data);
//        return $pdf->stream('document.pdf');
//    }

    public function generate_pdf()
    {
        $data = [
            'foo' => 'hello 1',
            'bar' => 'hello 2'
        ];
        $pdf = PDF::chunkLoadView('<html-separator/>', 'pdf.document', $data);
        return $pdf->stream('document.pdf');
    }

}
