<?php

namespace App\Http\Controllers;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Str;
class EmployeeController extends Controller
{
    public function add()  {
        
        $data['header_title']="Add New Employee";
        return view('employee.add', $data);
    }


    public function insert(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:500',
        'mobile' => 'nullable|unique:employee,mobile',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    try {
        $employee = new EmployeeModel;
        $employee->name = trim($request->name);
        $employee->address = trim($request->address);
        $employee->mobile = trim($request->mobile);
        $employee->salary = trim($request->salary);
        $employee->designation = trim($request->designation);
        $employee->holyday = trim($request->holyday);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/employee/', $fileName);
            $employee->photo = $fileName;
        }

        $employee->save();

        return redirect("employee/list")->with('success', 'One Employee Successfully Added');
    } catch (\Exception $e) {
        return redirect("employee/list")->with('error', 'Something Went Wrong: ' . $e->getMessage());
    }
}

public function list(Request $request) {
    $filters = $request->all(); 

    session(['employee_filters' => $filters]);

    $data['getRecord'] = EmployeeModel::getEmployee($filters);
    $data['header_title'] = "Employee List";

    return view('employee.list', $data);
}


public function edit($id)  {
    $data['getRecord'] = EmployeeModel::getSingle($id);
        $data['header_title']="Edit Employee";
        return view('employee.edit', $data);
}

public function update($id, Request $request)  {
        

        $employee =  EmployeeModel::getSingle($id);
        $employee->name = trim($request->name);
        $employee->address = trim($request->address);
        $employee->mobile = trim($request->mobile);
        $employee->salary = trim($request->salary);
        $employee->designation = trim($request->designation);
        $employee->holyday = trim($request->holyday);

    if(!empty($request->file('photo'))){

        if(!empty($employee->getProfile())){
            unlink('upload/employee/'.$employee->photo);

        }

        $ext=$request->file('photo')->getClientOriginalExtension();
        $file=$request->file('photo');
        $randomStr=date('Ymdhis').Str::random(20);
        $fileName=strtolower($randomStr).'.'.$ext;
        $file->move('upload/employee/',$fileName);

        $employee->photo=$fileName;
       }


       $employee->save();

       return redirect("employee/list")->with('succsess', 'Employee successfully edited');
    
}

public function print() {
    $filters = session('employee_filters', []); 

    $data['getRecord'] = EmployeeModel::getEmployee($filters);
    $data['header_title'] = "Print Employee";

    return view('employee.print', $data);
}
}
