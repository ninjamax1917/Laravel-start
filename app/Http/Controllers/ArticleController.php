<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Carbon\Factory;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View|Application
    {
        $articles = Article::query()
            ->select('id', 'title', 'created_at', 'user_id') // выбирает только указанные поля из таблицы articles
            ->with(['user:id,name']) // жадно загружает пользователя, но только с полями id и name
            ->withCount('comments') // добавляет к каждой статье количество комментариев (comments_count)
            ->latest()
            ->paginate(5); // разбивает результат на страницы по 5 статей на страницу

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        return $this->form(new Article());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        Article::query()->create($request->validated());

        return redirect()
        ->route('articles.index')->with('message', 'Статья добавлена');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): Factory|View|Application
    {
        return $this->form($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());

        return redirect()
        ->route('articles.index')->with('message', 'Статья обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete(); // удаляет статью из базы
        return redirect()

        ->route('articles.index')
        ->with('message', 'Статья удалена');
    }

    private function form(Article $article): Factory|View|Application
    {
        $users = User::query()
        ->pluck('name', 'id')
        ->toArray();

        return view('articles.form', [
    'users' => $users,
    'article' => $article,
]);
    }
}
