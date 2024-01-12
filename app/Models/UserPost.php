<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}