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

    static public function getSupplier()
    {
        $return = SupplierModel::select('customer.*');
            

        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('mobile'))) {
            $return = $return->where('mobile', 'like', '%' . Request::get('mobile') . '%');
        }

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }

        $return = $return->orderBy('id', 'asc')->paginate(20);

        return $return;
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
