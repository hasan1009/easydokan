<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;

    protected $table = 'products'; 

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getProducts()
{
    $return = ProductsModel::select('products.*', 'supplier.name as supplier_name')
        ->leftJoin('supplier', 'supplier.id', '=', 'products.supplier_id');

  
    if (!empty(Request::get('name'))) {
        $return = $return->where('products.name', 'like', '%' . Request::get('name') . '%');
    }

   
    if (!empty(Request::get('id'))) {
        $return = $return->where('products.id', '=', Request::get('id'));
    }

   
    if (!empty(Request::get('supplier_id'))) {
        $return = $return->where('products.supplier_id', '=', Request::get('supplier_id'));
    }

    $return = $return->orderBy('products.id', 'asc')->paginate(20);

    return $return;
}

    
    

    public function getProfileDirect() {
        if(!empty($this->photo) && file_exists('upload/products/'.$this->photo)){
            return url('upload/products/' .$this->photo);

        }else{
            return url('upload/products/dummy_product.jpg');
        }
        
    }


    public function getProfile() {
        if(!empty($this->photo) && file_exists('upload/products/'.$this->photo)){
            return url('upload/products/' .$this->photo);
        }else{
            return "";
        }
        
    }


    
}
