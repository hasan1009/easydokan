<?php

namespace App\Http\Controllers;
use App\Models\SellModel;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function list(Request $request) {
        $filters = $request->all(); 
    
        // Store filter values in session
        session(['product_filters' => $filters]);

        // Pass filters to getSell() method
        $data['getSell'] = SellModel::getSell($filters);
        $data['header_title'] = "Profit/Loss";

        return view('sell.list', $data);
    }


    public function print() {
        $filters = session('product_filters', []); 
    
        $data['getRecord'] = SellModel::getSell($filters);
        $data['header_title'] = "Print Sell Details";
    
        return view('sell.print', $data);
    }

}
