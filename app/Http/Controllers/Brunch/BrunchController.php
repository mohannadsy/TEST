<?php

namespace App\Http\Controllers\Brunch;

use App\Http\Controllers\Controller;
use App\Models\Brunch;
use Illuminate\Http\Request;

class BrunchController extends Controller
{
    public function index()
    {
        Brunch::get();
    }
    public function softDelete() // soft delete
    {
        Brunch::find(1)->Delete();
    }

    public function restore() // from recycle
    {
        Brunch::withTrashed()->find(1)->restore();
    }

    public function forceDelete() // soft delete
    {
        Brunch::find(1)->forceDelete();
    }

    public function create()
    {
        //
    }
   public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
