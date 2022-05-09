<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if(auth()->user()->isAdmin()){
            $notices = Notice::orderBy('id', 'DESC')->paginate(10);
        }else{
            $notices = auth()->user()->notices()->orderBy('id', 'DESC')->paginate(10);
        }

        return view('dashboard', compact('notices'));
    }
}
