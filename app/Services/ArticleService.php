<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    protected Article $article;
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getAll() : Collection
    {
        return $this->article->all();
    }

    public function getById(int $id) : Article
    {
        return $this->article->findOrFail($id);
    }

    public function create(array $request) : Article
    {
        return $this->article->create($request);
    }

    public function update(array $request, $id) : Article
    {
        $article = $this->article->findOrFail($id);
        $article->update($request);
        return $article;
    }

    public function like($articleId)
    {
        if(!$articleId->likes()->where('user_id', 1)->where('article_id', $articleId->id)->exists())
        {
            $articleId->likes()->attach(1);
        }
        return true;
    }

    public function unlike($articleId)
    {
        if($articleId->likes()->where('user_id', 1)->where('article_id', $articleId->id)->exists())
        {
            $articleId->likes()->detach(1);
        }
        return true;
    }
}
