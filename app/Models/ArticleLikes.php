<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleLikes extends Model
{
    protected $table = 'articles_likes';
    protected $fillable =
        [
            'article_id',
            'user_id',
        ];
}
