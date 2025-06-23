<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'content',
        'created_by',
        'updated_by',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id')->orderBy('id', 'asc');
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'created_by')->orderBy('id', 'asc');
    }

    public function user_updated()
    {
        return $this->belongsTo(User::class, 'updated_by')->orderBy('id', 'asc');
    }
}
