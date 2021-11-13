<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_title',
        'post_slug',
        'post_desc',
        'post_content',
        'post_meta_desc',
        'post_meta_keywords',
        'post_status',
        'post_image',
        'cate_post_id'
    ];

    protected $primaryKey = 'post_id';
    protected $table = 'tbl_post';

    public function catepost()
    {
        return $this->belongsTo('App\Models\Catepost', 'cate_post_id');
    }
}