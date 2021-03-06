<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function get_hello()
    {
        return 'hello';
    }

    // public function get_likes_cnt()
    // {
    //     return 
    // }
}
