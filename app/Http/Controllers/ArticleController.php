<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\User;
use Auth;

class ArticlesController extends Controller
{

    public function create(CreateArticle $request){
    	Auth::user()->articles()->associate(Article::create($request->all()));
    }
    public function read(){
    	return App\Article::active()->get();
    }
    public function userArticles(ShowUser $request, User $user) {
    	$user->articles->active()->get();
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
    public function restore(UpdateArticle $request, Article $article) {
    	if ($article->deleted) {
    		return $article->update(['deleted', 0]);
    	}    		
    	return $article;
    }
    public function addCategory(UpdateArticle $request, Article $article, Category $category) {
        $article->attach($category);
    }

}
