<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
        $user = $request->user();
        $data = $request->validated();
        $data['author'] = $user->id;
        $article = $this->articleService->create($data);
        return  new ArticleResource($article);
    }

    public function update(UpdateRequest $request, int $id) : ArticleResource
    {
        $user = $request->user();
        $data = $request->validated();
        $data['author'] = $user->id;
        $article = $this->articleService->update($data, $id);
        return new ArticleResource($article);
    }

    public function delete(int $id)
    {
        $this->articleService->deleteArticle($id);
        return response()->json([], 204);
    }

    public function like(Article $article, Request $request) : JsonResponse
    {
        $this->articleService->like($article, $request);
        return response()->json(['response' => 'success']);
    }

    public function unlike(Article $article, Request $request) : JsonResponse
    {
        $this->articleService->unlike($article, $request);
        return response()->json(['response' => 'success']);
    }


}
