<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_email',
        'customer_name',
        'customer_phone',
        'customer_password',
    ];

    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}
