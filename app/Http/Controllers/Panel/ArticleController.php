<?php


namespace App\Http\Controllers\Panel;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = [];
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')) {
            $articles = Article::all();
        }

        if (Auth::user()->hasRole('writer')) {
            $articles = Article::with('points')->where('author_id', Auth::id())->get();
        }

        return view('panel.article.index', compact('articles'));
    }

    public function delete(Article $article)
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator') || $article->author_id == Auth::id()) {
            $article->delete();
            return redirect(route('panel.article.index'));
        } else {
            return back()->with(['error' => 'Yetkisiz Erişim']);
        }
    }

    public function makePublishalbe(Article $article)
    {
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')) {
            $article->published = true;
            $article->save();
            return redirect(route('panel.article.index'));
        } else {
            return back()->with(['error' => 'Yetkisiz Erişim']);
        }
    }

}
