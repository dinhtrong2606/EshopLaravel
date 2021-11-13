<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catepost extends Model
{
    use HasFactory;
    protected $fillable = [
        'cate_post_name',
        'cate_post_slug',
        'cate_post_desc',
        'cate_post_status'
    ];

    protected $primaryKey = 'cate_post_id';
    protected $table = 'tbl_catepost';

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}