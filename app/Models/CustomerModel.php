<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customer'; 

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getCustomer($filters = [])
    {
        $return = CustomerModel::select('customer.*');
    
        // Apply filters from $filters array instead of Request::get()
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
        if(!empty($this->photo) && file_exists('upload/customer/'.$this->photo)){
            return url('upload/customer/' .$this->photo);

        }else{
            return url('upload/supplier/dummy_product.jpg');
        }
        
    }


    public function getProfile() {
        if(!empty($this->photo) && file_exists('upload/customer/'.$this->photo)){
            return url('upload/customer/' .$this->photo);
        }else{
            return "";
        }
        
    }
}
