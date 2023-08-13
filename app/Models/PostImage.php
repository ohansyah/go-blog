<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'path'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // SECTION: ACCESSORS
    public function getPathAttribute($value)
    {
        return file_exists(public_path('storage/' . $value)) ? $value : 'img/default.png';
    }
}
