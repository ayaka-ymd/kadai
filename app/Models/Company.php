<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function getLists()
    {
        $companies = DB::table("companies")->select("id", "company_name")->get();

        return $companies;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $table = 'companies';
    protected $guarded = ['id'];
    protected $fillable = ['company_name', 'street_address', 'representative_name'];
    protected $dates =  ['created_at', 'updated_at'];
}
