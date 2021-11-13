<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_name',
        'shipping_address',
        'shipping_email',
        'shipping_phone',
        'shipping_note',
    ];
    
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
}
