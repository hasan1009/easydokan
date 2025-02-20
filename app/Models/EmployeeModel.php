<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'employee'; 

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getEmployee($filters = [])
    {
        $return = EmployeeModel::select('employee.*');
    
        if (!empty($filters['name'])) {
            $return = $return->where('name', 'like', '%' . $filters['name'] . '%');
        }
    
        if (!empty($filters['mobile'])) {
            $return = $return->where('mobile', 'like', '%' . $filters['mobile'] . '%');
        }
    
        if (!empty($filters['id'])) {
            $return = $return->where('id', '=', $filters['id']);
        }
    
        return $return->orderBy('id', 'asc')->paginate(20);
    }
    

    public function getProfileDirect() {
        if(!empty($this->photo) && file_exists('upload/employee/'.$this->photo)){
            return url('upload/employee/' .$this->photo);

        }else{
            return url('upload/supplier/dummy_product.jpg');
        }
        
    }


    public function getProfile() {
        if(!empty($this->photo) && file_exists('upload/employee/'.$this->photo)){
            return url('upload/employee/' .$this->photo);
        }else{
            return "";
        }
        
    }
}
