<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        $request->validate([
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'body' => 'required|string',
            'published' => 'required|boolean',
            'path_image' => 'image'
        ]);
        
        $data = $request->all();
        $newArticle = new Article;
        
        $path = Storage::putFile('images', $request->file('path_image'));

        $newArticle->user_id = Auth::id();
        $newArticle->category_id = $data['category_id'];
        $newArticle->title = $data['title'];
        $newArticle->summary = $data['summary'];
        $newArticle->body = $data['body'];
        $newArticle->published = $data['published'];
        $newArticle->slug = Str::slug($data['title']) . '-' . Carbon::now()->isoFormat('Y-M-D');
        $newArticle->path_image = $path;

        $saved = $newArticle->save();

        if(!$saved) {
            return redirect()->back();
        }

        return redirect()->route('admin.articles.show', $newArticle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if(empty($article)){
            abort('404');
        }

       return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
