<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'content',
    ];

    protected $appends = [
        'created_at_format_dMY',
        'content_preview',
        'category_name'
    ];

    public function getCreatedAtFormatDMYAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    public function getContentPreviewAttribute()
    {
        return substr($this->content, 0, 400) . '...';
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? null;
    }

    public function postImage()
    {
        return $this->hasOne(PostImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function postTags()
    {
        return $this->hasMany(PostTag::class);
    }
}
