<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    
    public function getList() {
        $products = DB::table('products')->get();

        return $products;
       
    }

    public function newregister($data) {
        DB::table('products')->insert([
            'products' => $data->products,
            'companies' => $data->companies,
            'searchWord' => $data->searchWord,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
        ]);
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $table = 'products';
    protected $guarded = ['id'];
    protected $fillable = ['company_id', 'product_name', 'price', 'stook','comment', 'img_path'];
    protected $dates =  ['created_at', 'updated_at'];

    public static $rules = 
    [
        'img_path' => 'images|file',
    ];
}
