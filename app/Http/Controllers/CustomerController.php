<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Str;

class CustomerController extends Controller
{
    public function add()  {
        
        $data['header_title']="Add New Customer";
        return view('supplier.add', $data);
    }

    public function insert(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'paid' => 'nullable|numeric|min:0',
        'due' => 'nullable|numeric|min:0',
        'address' => 'nullable|string|max:500',
        'email' => 'nullable|email|max:255|unique:supplier,email',
        'mobile' => 'nullable|unique:supplier,mobile',
        'bank_name' => 'nullable|string|max:255',
        'bank_account_no' => 'nullable|string|max:50',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    try {
        $supplier = new SupplierModel;
        $supplier->name = trim($request->name);
        $supplier->description = trim($request->description);
        $supplier->paid = $request->filled('paid') ? floatval($request->paid) : 0;
        $supplier->due = $request->filled('due') ? floatval($request->due) : 0;
        $supplier->address = trim($request->address);
        $supplier->email = trim($request->email);
        $supplier->mobile = trim($request->mobile);
        $supplier->bank_name = trim($request->bank_name);
        $supplier->bank_account_no = trim($request->bank_account_no);

        // Handle image upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/supplier/', $fileName);
            $supplier->photo = $fileName;
        }

        $supplier->save();

        return redirect("supplier/list")->with('success', 'One Supplier Successfully Added');
    } catch (\Exception $e) {
        return redirect("supplier/list")->with('error', 'Something Went Wrong: ' . $e->getMessage());
    }
}


public function list()  {
        
    $data['getRecord']=SupplierModel::getSupplier();
    $data['header_title']="Suppliers List";
    return view('supplier.list', $data);
}


public function edit($id)  {
    $data['getRecord'] = SupplierModel::getSingle($id);
        $data['header_title']="Edit Supplier";
        return view('supplier.edit', $data);
}


public function update($id, Request $request)  {
        

    $supplier =  SupplierModel::getSingle($id);
    $supplier->name = trim($request->name);
    $supplier->description = trim($request->description);
    $supplier->paid = $request->filled('paid') ? floatval($request->paid) : 0;
    $supplier->due = $request->filled('due') ? floatval($request->due) : 0;
    $supplier->address = trim($request->address);
    $supplier->email = trim($request->email);
    $supplier->mobile = trim($request->mobile);
    $supplier->bank_name = trim($request->bank_name);
    $supplier->bank_account_no = trim($request->bank_account_no);

    if(!empty($request->file('photo'))){

        if(!empty($product->getProfile())){
            unlink('upload/supplier/'.$product->photo);

        }

        $ext=$request->file('photo')->getClientOriginalExtension();
        $file=$request->file('photo');
        $randomStr=date('Ymdhis').Str::random(20);
        $fileName=strtolower($randomStr).'.'.$ext;
        $file->move('upload/supplier/',$fileName);

        $supplier->photo=$fileName;
       }


       $supplier->save();

       return redirect("supplier/list")->with('succsess', 'Supplier successfully edited');
    
}

public function print()  {
    $data['getRecord'] =  SupplierModel::getSupplier();
    $data['header_title']="Print Supplier";
    return view('supplier.print',$data);
}
}
