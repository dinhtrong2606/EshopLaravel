<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_id',
        'customer_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

    public function customers(){
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function shipping(){
        return $this->belongsTo('App\Models\Shipping', 'shipping_id');
    }
}
