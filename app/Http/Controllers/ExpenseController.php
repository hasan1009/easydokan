<?php

namespace App\Http\Controllers;
use App\Models\ExpenseModel;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function add()  {
        
        $data['header_title']="Add New Expense";
        return view('expense.add', $data);
    }

    public function insert(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'expense_date' => 'required|date',
        'remarks' => 'nullable|string|max:500',
    ]);

    try {
        $expense = new ExpenseModel;
        $expense->name = trim($request->name);
        $expense->amount = trim($request->amount);
        $expense->expense_date = trim($request->expense_date);
        $expense->remarks = trim($request->remarks);
        $expense->save();

        return redirect("expense/list")->with('succsess', 'One Expense Successfully Added');
    } catch (\Exception $e) {
        return redirect("expense/list")->with('error', 'Something Went Wrong: ' . $e->getMessage());
    }
}

public function list(Request $request) {
    $filters = $request->all();
    $today = now();

    // If no filter is applied, set default to "This Month"
    if (!$request->has('filter') && empty($filters['from_date']) && empty($filters['to_date'])) {
        $filters['from_date'] = $today->startOfMonth()->toDateString();
        $filters['to_date'] = $today->endOfMonth()->toDateString();
        $filters['filter'] = 'this_month'; // Used for highlighting the button
    }

    // Apply date filters based on the query parameter
    if ($request->has('filter')) {
        switch ($request->filter) {
            case 'this_month':
                $filters['from_date'] = $today->startOfMonth()->toDateString();
                $filters['to_date'] = $today->endOfMonth()->toDateString();
                break;

            case 'previous_month':
                $filters['from_date'] = $today->subMonth()->startOfMonth()->toDateString();
                $filters['to_date'] = $today->endOfMonth()->toDateString();
                break;

            case 'this_year':
                $filters['from_date'] = $today->startOfYear()->toDateString();
                $filters['to_date'] = $today->endOfYear()->toDateString();
                break;

            case 'lifetime':
                unset($filters['from_date'], $filters['to_date']);
                break;
        }
    }

    session(['expense_filters' => $filters]);

    $data['getRecord'] = ExpenseModel::getExpense($filters);
    $data['header_title'] = "Expense List";
    $data['selected_filter'] = $filters['filter'] ?? ''; 

    return view('expense.list', $data);
}


public function edit($id)  {
    $data['getRecord'] = ExpenseModel::getSingle($id);
        $data['header_title']="Edit Expense";
        return view('expense.edit', $data);
}

public function update($id, Request $request){

    $expense =  ExpenseModel::getSingle($id);
    $expense->name = trim($request->name);
    $expense->amount = trim($request->amount);
    $expense->expense_date = trim($request->expense_date);
    $expense->remarks = trim($request->remarks);
    $expense->save();

    return redirect("expense/list")->with('succsess', 'Expense successfully edited');

}

public function print() {
    $filters = session('expense_filters', []); 

    $data['getRecord'] = ExpenseModel::getExpense($filters);
    $data['header_title'] = "Print Expense";

    return view('expense.print', $data);
}


}
