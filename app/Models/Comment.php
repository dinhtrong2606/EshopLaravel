<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'email',
        'comment_content',
        'comment_status',
    ];

    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
