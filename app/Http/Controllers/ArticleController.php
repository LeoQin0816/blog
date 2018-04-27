<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Texts;

class ArticleController extends BaseController
{
    //
    public function index(Texts $text,Request $request)
    {
        $id = $request->input('id');
        $text->where('id',$id)->increment('is_read');
        $article = $text->where('id',$id)->select('id','title','summary','updated_at','image','text','is_read')->first();
        $previous = $text->where([['id','<',$id],['is_show',1]])->select('id','title')->orderBy('id','desc')->limit(1)->first();
        $next = $text->where([['id','>',$id],['is_show',1]])->select('id','title')->orderBy('id','asc')->limit(1)->first();
        
        return response()->json(['article'=>$article,'previous'=>$previous,'next'=>$next]);
    }
}
