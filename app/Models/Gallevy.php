<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallevy extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'gallevy_name',
        'gallevy_image',
        'product_id'
    ];

    protected $primaryKey = 'gallevy_id';
    protected $table = 'tbl_gallevy';
}