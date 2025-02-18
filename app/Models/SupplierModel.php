<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'supplier'; 

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getSupplier($filters = [])
    {
        $return = SupplierModel::select('supplier.*');
    
        // Apply filters from $filters array instead of Request::get()
        if (!empty($filters['name'])) {
            $return = $return->where('name', 'like', '%' . $filters['name'] . '%');
        }
    
        if (!empty($filters['mobile'])) {
            $return = $return->where('mobile', 'like', '%' . $filters['mobile'] . '%');
        }
    
        if (!empty($filters['email'])) {
            $return = $return->where('email', 'like', '%' . $filters['email'] . '%');
        }
    
        if (!empty($filters['id'])) {
            $return = $return->where('id', '=', $filters['id']);
        }
    
        return $return->orderBy('id', 'asc')->paginate(20);
    }
    

    public function getProfileDirect() {
        if(!empty($this->photo) && file_exists('upload/supplier/'.$this->photo)){
            return url('upload/supplier/' .$this->photo);

        }else{
            return url('upload/products/dummy_product.jpg');
        }
        
    }


    public function getProfile() {
        if(!empty($this->photo) && file_exists('upload/supplier/'.$this->photo)){
            return url('upload/supplier/' .$this->photo);
        }else{
            return "";
        }
        
    }

}
