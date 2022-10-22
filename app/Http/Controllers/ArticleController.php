<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    // Only for login user except index & detail
    public function __construct() {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    // Show all articles
    public function index() {
        $data = Article::latest()->paginate(3);

        return view('articles.index', [
            'articles' => $data
        ]);
    }

    // Show my articles
    public function myArticles() {
        $data = Article::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('articles.my_articles', [
            'articles' => $data
        ]);
    }

    // Show single article
    public function detail($id) {
        $data = Article::find($id);

        return view('articles.detail', [
            'article' => $data
        ]);
    }

    // Add article form
    public function add() {
        $categories = Category::all();

        return view('articles.add', [
            'categories' => $categories
        ]);
    }

    // Create article
    public function create() {
        validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ])->validate();

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->user_id = auth()->id();
        $article->category_id = request()->category_id;
        $article->save();

        return redirect('/')->with('message', 'Article created successfully.');
    }

    // Edit article form
    public function edit($id) {
        $data = Article::find($id);
        $categories = Category::all();

        return view('articles.edit', [
            'article' => $data,
            'categories' => $categories
        ]);
    }

    // Update article
    public function update($id) {
        validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ])->validate();

        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect("/articles/detail/$id")->with('message', 'Article updated successfully.');
    }

    // Delete article
    public function delete($id) {
        $article = Article::find($id);

        if(Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect("/articles/my_articles")->with('message', 'Article deleted successfully.');
        } else {
            return back()->with('error', 'Unauthorized action !');
        }
    }
}
