<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'title',
            'content',
            'author',
        ];

    public function likes()
    {
        return $this->belongsToMany(User::class, 'articles_likes');
    }
}
