<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\SupplierModel;
use App\Models\SellModel;

use Str;

class ProductsController extends Controller
{
    public function add()  {
        
        $data['header_title']="Add New Product";
        return view('products.add', $data);
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
        ]);
    
        try {
            $product = new ProductsModel;
            $product->name = trim($validatedData['name']);
            $product->description = trim($validatedData['description']);
            $product->unit = trim($validatedData['unit']);
    
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $randomStr = date('Ymdhis') . Str::random(20);
                $fileName = strtolower($randomStr) . '.' . $ext;
                $file->move('upload/products/', $fileName);
                $product->photo = $fileName;
            }
    
            $product->save();
    
            return redirect("products/list")->with('succsess', 'One Product Successfully Added');
        } catch (\Exception $e) {
            return redirect("products/list")->with('error', 'Something Went Wrong: ' . $e->getMessage());
        }
    }



    public function list(Request $request) {
        $filters = $request->all(); // Get all filters from request
    
        // Store filter values in session
        session(['product_filters' => $filters]);
    
        $data['getRecord'] = ProductsModel::getProducts($filters);
        $data['getSupplier'] = SupplierModel::getSupplier();
        $data['header_title'] = "Products List";
    
        return view('products.list', $data);
    }

    

    public function purchase($id, Request $request)  {

        $purchase = ProductsModel::getSingle($id);
        $purchase->purchase_price = trim($request->purchase_price);
        $purchase->sell_price = trim($request->sell_price);
        $purchase->quantity = $purchase->quantity+$request->quantity;
        $purchase->supplier_id = trim($request->supplier_id);
        
        if(!empty($request->expire_date)){
            $purchase->expire_date = trim($request->expire_date);
    
           }
           if(!empty($request->purchase_date)){
            $purchase->purchase_date = trim($request->purchase_date);
    
           }
        
       
        $purchase->save();
        return back()->with('succsess', 'Product successfully updated.');
    }




    public function edit($id)  {
        $data['getRecord'] = ProductsModel::getSingle($id);
            $data['header_title']="Edit Product";
            $data['getSupplier']=SupplierModel::getSupplier();
            return view('products.edit', $data);
    }



    public function update($id, Request $request)  {
        

        $product =  ProductsModel::getSingle($id);
        $product->name = trim($request->name);
        $product->description = trim($request->description);
        $product->purchase_price = trim($request->purchase_price);
        $product->sell_price = trim($request->sell_price);
        $product->unit = trim($request->unit);
        $product->quantity = trim($request->quantity);
        $product->expire_date = trim($request->expire_date);
        $product->purchase_date = trim($request->purchase_date);

        if(!empty($request->file('photo'))){

            if(!empty($product->getProfile())){
                unlink('upload/products/'.$product->photo);
    
            }
    
            $ext=$request->file('photo')->getClientOriginalExtension();
            $file=$request->file('photo');
            $randomStr=date('Ymdhis').Str::random(20);
            $fileName=strtolower($randomStr).'.'.$ext;
            $file->move('upload/products/',$fileName);
    
            $product->photo=$fileName;
           }


           $product->save();

           return redirect("products/list")->with('succsess', 'Product successfully edited');
        
    }


    public function print() {
        $filters = session('product_filters', []); // Retrieve filters from session
    
        $data['getRecord'] = ProductsModel::getProducts($filters);
        $data['header_title'] = "Filtered Products Details";
    
        return view('products.print', $data);
    }


    
    public function sell($id, Request $request)  {

        $sell = new SellModel;
        $sell->product_id = trim($request->product_id);
        $sell->buy_price = trim($request->buy_price);
        $sell->sell_price = trim($request->sell_price);
        $sell->sell_quantity = trim($request->sell_quantity);
        $sell->sell_date = trim($request->sell_date);
        $sell->save();

        $product = ProductsModel::getSingle($id);
        $product->quantity = $product->quantity-$request->sell_quantity;
        $product->save();
        return back()->with('succsess', 'Product successfully updated.');
    }

}
