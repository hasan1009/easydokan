<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ExpenseModel extends Model
{
    use HasFactory;

    protected $table = 'expense'; 

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getExpense($filters = [])
    {
        $return = ExpenseModel::select('expense.*');
    
        // Apply filters from $filters array
        if (!empty($filters['name'])) {
            $return = $return->where('expense.name', 'like', '%' . $filters['name'] . '%');
        }
    
        if (!empty($filters['id'])) {
            $return = $return->where('expense.id', '=', $filters['id']);
        }
    
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $return = $return->whereBetween('expense.expense_date', [$filters['from_date'], $filters['to_date']]);
        } elseif (!empty($filters['from_date'])) {
            $return = $return->where('expense.expense_date', '>=', $filters['from_date']);
        } elseif (!empty($filters['to_date'])) {
            $return = $return->where('expense.expense_date', '<=', $filters['to_date']);
        }
    
        return $return->orderBy('expense.id', 'desc')->paginate(20);
    }
}
