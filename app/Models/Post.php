<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'file_name',
        'created_by',
        'updated_by',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');;
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
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
