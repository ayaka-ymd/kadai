<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $guarded = ['id'];
    protected $table = 'products';
    protected $fillable = ['company_id', 'product_name', 'price', 'stook','comment', 'img_path'];
    protected $dates =  ['created_at', 'updated_at'];

    public static $rules = 
    [
        'img_path' => 'images|file',
    ];
}
