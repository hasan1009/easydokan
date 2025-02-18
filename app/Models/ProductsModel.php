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

    static public function getProducts($filters = [])
{
    $return = ProductsModel::select('products.*', 'supplier.name as supplier_name')
        ->leftJoin('supplier', 'supplier.id', '=', 'products.supplier_id');

    // Use $filters array instead of Request::get()
    if (!empty($filters['name'])) {
        $return = $return->where('products.name', 'like', '%' . $filters['name'] . '%');
    }

    if (!empty($filters['id'])) {
        $return = $return->where('products.id', '=', $filters['id']);
    }

    if (!empty($filters['supplier_id'])) {
        $return = $return->where('products.supplier_id', '=', $filters['supplier_id']);
    }

    return $return->orderBy('products.id', 'asc')->paginate(20);
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
