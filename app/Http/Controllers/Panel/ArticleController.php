<?php


namespace App\Http\Controllers\Panel;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
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
        return view('panel.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('panel.articles.create');
    }

    public function edit(Article $article)
    {
        if ((Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')) ||
            (Auth::user()->hasRole('writer') && $article->author_id == Auth::id())) {
            return view('panel.articles.edit', compact('article'));
        } else {
            return redirect()->back()->with('error', 'Yetkisiz erişim');
        }
    }

    public function update(Request $request, Article $article)
    {

        $input = $request->all();
        $article->update($input);
        return redirect(route('panel.article.index'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['author_id'] = Auth::id();
        Article::create($input);
        return redirect(route('panel.article.index'));
    }

    public function delete(Article $article)
    {
        if ((Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')) ||
            (Auth::user()->hasRole('writer') && $article->author_id == Auth::id())) {
            $article->delete();
            return redirect(route('panel.article.index'));

        } else {
            return redirect()->back()->with('error', 'Yetkisiz erişim');
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
