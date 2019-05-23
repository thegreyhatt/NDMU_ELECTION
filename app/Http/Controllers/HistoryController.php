<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    
    public function votes()
    {   
        // dd(view('admin.votes')/);
        return view('admin.votes');
    }
}
