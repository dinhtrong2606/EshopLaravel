<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
        'slugbrand',
        'brand_desc',
        'brand_status'
    ];

    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand_product';

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
