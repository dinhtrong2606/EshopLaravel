<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'coupon_code',
        'product_price',
        'product_sales_quatity'
    ];

    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_detail';

    public function products(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}


