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
        return $this->article->where('id', $id)->first();
    }

    public function create(array $request) : Article
    {
        return $this->article->create($request);
    }

    public function update(array $request, $id) : Article
    {
        $this->article->find($id)->update($request);
        return $this->article->find($id);
    }
}
