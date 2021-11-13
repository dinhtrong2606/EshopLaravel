<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_title',
        'video_slug',
        'video_image',
        'video_link',
        'video_desc'
    ];

    protected $primaryKey = 'video_id';
    protected $table = 'tbl_videos';
}