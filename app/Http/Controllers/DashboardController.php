<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()  {
        
        // $data['getRecord']=User::getAdmin();
        $data['header_title']="Dashboard";
        return view('backend.dashboard', $data);
    }
    
}