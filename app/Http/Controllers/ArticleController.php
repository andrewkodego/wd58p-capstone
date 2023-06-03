<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $articleList = Article::userRecordsOnly('articles.index')->where('id','>',0);

        $filters = $request->all();

        if(array_key_exists('title', $filters)){
            $articleList->where('title', 'like','%'.$filters['title'].'%');
        }

        $articleList->orderby('deleted_at', 'asc');
        $articleList->orderby('id', 'asc');

        $articleList = $articleList->paginate(config('constants.RECORD_PER_PAGE'));

        return view('console/articles/index', compact('articleList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request) : RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article) : RedirectResponse
    {
        $error = [];

        if($article->canEditRecord('articles.index')){
            return view('console/articles/edit', compact('error','article'));
        }

        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        if($article->canEditRecord('articles.index')){
            //
        }

        abort(401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article) : RedirectResponse
    {
        if($article->canDeleteRecord('articles.index')){
            $article->delete();

            return Redirect::route('articles.index')->with('status','Record has been deleted.'); 
        }

        abort(401);
    }
}
