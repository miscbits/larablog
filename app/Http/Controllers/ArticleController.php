<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\User;
use Auth;
use App\Http\Requests\ShowArticle;

class ArticleController extends Controller
{

    public function create(CreateArticle $request){
        $article = new Article($request->all());
    	Auth::user()->articles()->save($article);
        $article->update();
    }
    public function read(){
    	return Article::active()->get();
    }
    public function userArticles(ShowUser $request, User $user) {
    	$user->articles->active()->get();
    }
    public function update(UpdateArticle $request, Article $article){
    	$article->update($request->all());
    }
    public function destroy(UpdateArticle $request, Article $article){
    	if($article->deleted) {
            $article->destroy();
        }   
        else {
    		$article->update('deleted', 1);
        }
    }
    public function show(ShowArticle $request, Article $article){
    	$article->user;
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
