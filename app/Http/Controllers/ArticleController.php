<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArticleController extends Controller
{
    public function index()
    {
        $search = request()->query('search');

        if($search){
            $articles = Article::where('title', 'LIKE', "%{$search}%")->simplePaginate(3);
        }else{
            $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        }

        $tag = Tag::all();

        return view('articles.index')->with('articles', $articles)->with('tag', $tag);
    }

    public function create()
    {
        $tag = Tag::all();

        return view('articles.create')->with('tag', $tag);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:190|min:10',
            'articleText' => 'required|min:20'
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->articleText = $request->input('articleText');
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect()->home();
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show')->with('article', $article);
    }

    public function edit($id)
    {
        $article = Article::find($id);

        if(auth()->user()->id != $article->user_id)
            return redirect('/articles')->with('error', 'Вы не авторизованы');

        return view('articles.edit')->with('article', $article);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:190|min:10',
            'articleText' => 'required|min:20'
        ]);

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->articleText = $request->input('articleText');
        $article->save();

        return redirect('/')->with('success', 'Статья была обновлена');
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if(auth()->user()->id != $article->user_id)
            return redirect('/articles')->with('error', 'Вы не авторизованы');

        $article->delete();
        return redirect('/')->with('success', 'Статья была удалена');
    }
}
