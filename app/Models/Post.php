<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'slug',
    ];

    protected $appends = [
        'created_at_format_dMY',
        'content_preview',
        'category_name',
    ];

    public function getCreatedAtFormatDMYAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    public function getContentPreviewAttribute()
    {
        return strip_tags(substr($this->content, 0, 300)) . '...';
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? null;
    }

    /**
     * MUTATOR SECTION
     */

    protected function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->title);
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

    public function userPost()
    {
        return $this->hasOne(UserPost::class);
    }

    /**
     * SECTION: SCOPES
     */
    public function scopeFilter($query, $request)
    {
        if (!$request || empty($request)) {
            return $query;
        }

        if (isset($request['category_id']) && $request['category_id'] != 'all') {
            $query->where('category_id', $request['category_id']);
        }

        if (isset($request['tag_id']) && $request['tag_id'] != 'all') {
            $query->whereHas('postTags', function ($q) use ($request) {
                $q->where('tag_id', $request['tag_id']);
            });
        }

        return $query;
    }
}
