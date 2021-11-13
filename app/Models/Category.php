<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
        'category_parent',
        'slugdanhmuc'
    ];

    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}