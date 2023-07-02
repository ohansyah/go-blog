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
        'content_preview'
    ];

    public function getCreatedAtFormatDMYAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    public function getContentPreviewAttribute()
    {
        return substr($this->content, 0, 400) . '...';
    }

    public function postImage()
    {
        return $this->hasOne(PostImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}