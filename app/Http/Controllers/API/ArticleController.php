<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Article::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return $this->sendError('Makale buluamadı!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
