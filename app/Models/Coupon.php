<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_name',
        'coupon_time',
        'coupon_condition',
        'coupon_number',
        'coupon_code',
    ];

    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
}