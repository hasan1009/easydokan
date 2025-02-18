<?php

namespace App\Http\Controllers;
use App\Models\CustomerModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function pos()  {
        
        $data['header_title']="Point of Sell";
        $data['getCustomer'] =  CustomerModel::getCustomer();
        $data['getProduct'] =  ProductsModel::getProducts();
        return view('pos.pos', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
        ]);

        $order = new Order();
        $order->customer_id = $data['customer_id'];
        $order->total_amount = collect($data['products'])->sum(fn ($p) => $p['price'] * $p['quantity']);
        $order->save();

        foreach ($data['products'] as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'total' => $product['price'] * $product['quantity'],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
