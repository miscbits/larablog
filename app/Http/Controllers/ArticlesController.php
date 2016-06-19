<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Articles;

class ArticlesController extends Controller
{
    public function create(){

    }
    public function read(){
    	return App\Article::where('published', 1)->where('published_at', '<', Carbon\Carbon::now())->where('deleted', '!=', 1)->get();
    }
    public function update(UpdateArticle $request, Article $article){
    	$article->update($request->all());
    }
    public function destroy(UpdateArticle $request, Article $article){
    	if($article->deleted)
    		$article->destroy;
    	else
    		$article->update('deleted', 1);
    }
    public function show(ShowArticle $request, Article $article){
    	return $article;
    }

}
