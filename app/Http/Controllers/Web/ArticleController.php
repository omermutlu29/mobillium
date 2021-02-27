<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticlePoint;
use App\Models\Point;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $articles = Article::with('author')->where('published', true)->paginate(3);
        return view('web.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        if ($article->published == true) {
            $points=Point::all();
            $next=Article::where('id','>',$article->id)->where('published',true)->first();
            $prev=Article::where('id','<',$article->id)->where('published',true)->first();
            return view('web.articles.show', compact('article','points','prev','next'));
        }else{
            return redirect()->back();
        }
    }

    public function rate(Article $article,Request $request)
    {
        if (Auth::check()) {
            $rate = $article->points()->where('user_id', Auth::id())->first();
            if (!$rate) {
                $validator = Validator::make($request->all(), [
                    'rate' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Hatalı gönderim'
                    ]);
                }
                if ($request->rate > 5 || $request->rate < 0) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Hatalı gönderim'
                    ]);
                }
                $point=Point::find($request->rate);
                $article->points()->save($point,['user_id'=>Auth::id()]);

                return response()->json([
                    'status' => true,
                    'message' => 'Başarı ile oylandı!'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Zaten bir oy vermişsiniz!'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Üye olmadan oy veremezsiniz'
            ]);
        }
    }


}
