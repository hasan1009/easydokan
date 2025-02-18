<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Str;

class CustomerController extends Controller
{

    public function add()  {
        
        $data['header_title']="Add New Customer";
        return view('customer.add', $data);
    }

    public function insert(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'due' => 'nullable|numeric|min:0',
        'address' => 'nullable|string|max:500',
        'mobile' => 'nullable|unique:customer,mobile',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    try {
        $customer = new CustomerModel;
        $customer->name = trim($request->name);
        $customer->due = $request->filled('due') ? floatval($request->due) : 0;
        $customer->paid = $request->filled('paid') ? floatval($request->paid) : 0;
        $customer->address = trim($request->address);
        $customer->mobile = trim($request->mobile);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/customer/', $fileName);
            $customer->photo = $fileName;
        }

        $customer->save();

        return redirect("customer/list")->with('success', 'One Customer Successfully Added');
    } catch (\Exception $e) {
        return redirect("customer/list")->with('error', 'Something Went Wrong: ' . $e->getMessage());
    }
}


public function list(Request $request) {
    $filters = $request->all(); // Get all filters from request

    // Store filter values in session
    session(['customer_filters' => $filters]);

    $data['getRecord'] = CustomerModel::getCustomer($filters);
    $data['header_title'] = "Customer List";

    return view('customer.list', $data);
}



public function edit($id)  {
    $data['getRecord'] = CustomerModel::getSingle($id);
        $data['header_title']="Edit Customer";
        return view('customer.edit', $data);
}


public function update($id, Request $request)  {
        

    $customer =  CustomerModel::getSingle($id);
    $customer->name = trim($request->name);
    $customer->due = $request->filled('due') ? floatval($request->due) : 0;
    $customer->paid = $request->filled('paid') ? floatval($request->paid) : 0;
    $customer->address = trim($request->address);
    $customer->mobile = trim($request->mobile);

    if(!empty($request->file('photo'))){

        if(!empty($customer->getProfile())){
            unlink('upload/customer/'.$customer->photo);

        }

        $ext=$request->file('photo')->getClientOriginalExtension();
        $file=$request->file('photo');
        $randomStr=date('Ymdhis').Str::random(20);
        $fileName=strtolower($randomStr).'.'.$ext;
        $file->move('upload/customer/',$fileName);

        $customer->photo=$fileName;
       }


       $customer->save();

       return redirect("customer/list")->with('succsess', 'Customer successfully edited');
    
}

public function print() {
    $filters = session('customer_filters', []); // Retrieve filters from session

    $data['getRecord'] = CustomerModel::getCustomer($filters);
    $data['header_title'] = "Print Customer";

    return view('customer.print', $data);
}


  public function paiddue($id, Request $request){
    $customer =  CustomerModel::getSingle($id);
    $customer->paid =$customer->paid + $request->paid;
    $customer->due =$customer->due + $request->due;
    $customer->save();

    return back()->with('succsess', 'Customer successfully updated.');
  } 
}
