<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Carbon\Factory;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            ->paginate(5); // разбивает результат на страницы по 5 статей на страницу

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        return view('articles.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'title' => 'required|string|min:5',
            'text' => 'required|string|min:10',
        ]);

        dd($data);

        Article::query()->create($request->only(['user_id', 'title', 'text']));

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
