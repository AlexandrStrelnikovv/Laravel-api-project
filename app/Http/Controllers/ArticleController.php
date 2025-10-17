<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected ArticleService $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index() : ArticleCollection
    {
        return new ArticleCollection($this->articleService->getAll());
    }

    public function show(int $id) : ArticleResource
    {
        return new ArticleResource($this->articleService->getById($id));
    }

    public function store(StoreRequest $request) : ArticleResource
    {
        $article = $this->articleService->create($request->validated());
        return  new ArticleResource($article);
    }

    public function update(StoreRequest $request, int $id) : ArticleResource
    {
        $article = $this->articleService->update($request->validated(), $id);
        return new ArticleResource($article);
    }


}
