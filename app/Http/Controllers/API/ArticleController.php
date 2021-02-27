<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return $this->sendResponse(Article::with('author')->get(), 'Makaleler Getirildi!');
    }

    public function store(Request $request)
    {
        if (!(Auth::user()->hasRole('writer') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Eksik veri gönderimi!', $validator->errors());
        }
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'published' => false,
            'author_id' => Auth::id()
        ]);
        return $this->sendResponse($article, 'Veriler başarı ile kaydedildi!');
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return $this->sendError('Makale buluamadı!');
        }
        if (Auth::user()->hasRole('writer') && $article->author_id != Auth::id()) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }
        if (!(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }

        $input = $request->all();
        $article->fill($input)->save();
        return $this->sendResponse($article, 'Başarı ile güncellendi!');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return $this->sendError('Makale buluamadı!');
        }
        if (Auth::user()->hasRole('writer') && $article->author_id != Auth::id()) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }
        if (!(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }
        $article->delete();
        return $this->sendResponse([], 'makale silindi!');
    }

    public function unpublish($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return $this->sendError('Makale buluamadı!');
        }
        if (Auth::user()->hasRole('writer') && $article->author_id != Auth::id()) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }
        if (!(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))) {
            return $this->sendError('Yetkisiz erişim', 'Yetkisiz erişim');
        }
        $article->published = false;
        $article->save();
        return $this->sendResponse($article, 'Yayından kalktı!');
    }
}
