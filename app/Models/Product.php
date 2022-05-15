<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'product_tags',
        'product_name',
        'slugproduct',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status',
        'product_exist'
    ];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}