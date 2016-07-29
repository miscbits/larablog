<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function __construct(ArticleService $articleService)
    {
        $this->service = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = $this->service->paginated();
        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $articles = $this->service->search($request->search);
        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('articles.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('articles.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the articles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->service->find($id);
        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the articles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->service->find($id);
        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the articles in storage.
     *
     * @param  \Illuminate\Http\ArticleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the articles from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('articles.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('articles.index'))->with('message', 'Failed to delete');
    }
}
