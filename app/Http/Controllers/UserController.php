<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


//use Barryvdh\DomPDF\Facade as PDF;   // true

use Barryvdh\DomPDF\Facade\Pdf;


//use Barryvdh\DomPDF as PDF;
//use Barryvdh\DomPDF\PDF;
//use Barryvdh\DomPDF;


class UserController extends Controller
{
    //


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


    public function downloadPDF($id)
    {
        $user = User::find($id);

        $pdf = Pdf::loadView('pdf.pdf', compact('user'));
        return $pdf->download('users.pdf');

    }


    public function index()
    {

        $users = User::all();

        return view('pdf.index', compact('users'));
    }


}


//public function print(){
//$details =['title' => 'test'];
//       $pdf = PDF::loadView('textDoc', $details);
//       return $pdf::download('this.pdf');
//    }


//
//public function index(){
//    $pdf = PDF::loadView('welcome');
//    return $pdf->download('invoice.pdf');
//}



//public function download()
//{
//    $sales = Sales_details::all();
//    $pdf=PDF::loadView('Sales_details.view1',['sales'->$sales]);
//    return $pdf->download('sales.pdf');
//
//}


//
////false
//$pdf = app('dompdf.wrapper');
//$pdf->loadView('view');
////true
//$pdf = \App::make('dompdf.wrapper');
//$pdf->loadView('invoices.credit_note', compact('credit_notes'));
//$pdf->save(public_path($path));


//public function downloadPDF($id){
//    $user = User::find($id);
//
//    $pdf = \Barryvdh\DomPDF\PDF::loadView('pdf.pdf', compact('user'));
//    return $pdf->download('invoice.pdf');
//
//}


//true
//public function export_pdf(Order $order)
//{
//    $report =  Report::findOrFail($order);
//    //$pdf = PDF::loadView('Home.report')->setPaper('a4', 'portrait');
//    $pdf = app('dompdf.wrapper');
//    $pdf->loadView('Home.report');
//    $fileName = $report->issue_number;
//    return $pdf->stream($fileName.'.pdf');
//}
//false
//public function export_pdf(Report $report)
//{
//    $report =  Report::findOrFail($report);
//    $pdf = PDF::loadView('Home.report')->setPaper('a4', 'portrait');
//    $fileName = $report->issue_number;
//    return $pdf->stream($fileName.'.pdf');
//}
