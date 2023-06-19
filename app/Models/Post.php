<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    protected $appends = [
        'created_at_format_dMY',
    ];

    public function getCreatedAtFormatDMYAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    public function postImage()
    {
        return $this->hasOne(PostImage::class);
    }
}