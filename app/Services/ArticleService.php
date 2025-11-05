<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

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

    public function deleteArticle(int $id) : bool
    {
        $this->article->delete($id);
        return true;
    }
    public function like($articleId, User $user)
    {
        if(!$articleId->likes()->where('user_id', $user->id)->where('article_id', $articleId->id)->exists())
        {
            $articleId->likes()->attach($user->id);
        }
        return true;
    }

    public function unlike($articleId,  User $user)
    {
        if($articleId->likes()->where('user_id', $user->id)->where('article_id', $articleId->id)->exists())
        {
            $articleId->likes()->detach($user->id);
        }
        return true;
    }
}
