<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class SellModel extends Model
{
    use HasFactory;

    protected $table = 'sell'; 


    static public function getSingle($id){
        return self::find($id);
    }

    static public function getSell($filters = [])
{
    $return = SellModel::select('sell.*', 'products.name as productname', 'products.unit as unit', 'products.photo as photo')
        ->leftJoin('products', 'products.id', '=', 'sell.product_id');

    // Apply filters from $filters array
    if (!empty($filters['name'])) {
        $return = $return->where('products.name', 'like', '%' . $filters['name'] . '%');
    }

    if (!empty($filters['id'])) {
        $return = $return->where('products.id', '=', $filters['id']);
    }

    if (!empty($filters['supplier_id'])) {
        $return = $return->where('products.supplier_id', '=', $filters['supplier_id']);
    }

    // Date range filtering
    if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
        $return = $return->whereBetween('sell.sell_date', [$filters['from_date'], $filters['to_date']]);
    } elseif (!empty($filters['from_date'])) {
        $return = $return->where('sell.sell_date', '>=', $filters['from_date']);
    } elseif (!empty($filters['to_date'])) {
        $return = $return->where('sell.sell_date', '<=', $filters['to_date']);
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



}
