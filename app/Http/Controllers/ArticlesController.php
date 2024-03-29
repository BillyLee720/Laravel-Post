<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }
    //
    public function index(){
        $articles = Article::orderBy('created_at','desc')->paginate(3);
        return view('articles.index',['articles'=>$articles]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        
        $content = $request->validate([
            'title' => 'required',
            'content' => 'required|min:10'
        ]);

        auth()->user()->articles()->create($content);
        return redirect()->route('root')->with('notice','文章新增成功');
    }

    public function edit($id){
        $article = auth()->user()->articles()->find($id);
        return view('articles.edit',['article' => $article]);
    }
    

    public function update(Request $request,$id){
        $article = auth()->user()->articles()->find($id);
        $content = $request->validate([
            'title'=>'required',
            'content' => 'required|min:10'
        ]);

        $article->update($content);
        return redirect()->route('root')->with('notice','文章更新成功!');
    }

    public function show($id){
        $article = auth()->user()->articles()->find($id);

        return view('articles.show',['article'=>$article]);
    }

    public function destroy($id){
        $article = auth()->user()->articles->find($id);

        $article->delete();
        return redirect()->route('root')->with('notice','文章已刪除!');
    }
}
