<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index() 
    {
        $articles = Article::where('published', '1')->get();
        return view('guest.articles.index', compact('articles'));
    }

    public function home()
    {
        $categoryPolitica = Category::where('name', 'politica')->first();
        $articlePolitica = $categoryPolitica->articles()->where('published', '1')->orderBy('updated_at', 'DESC')->limit(3)->get();

        $categoryCronaca = Category::where('name', 'cronaca')->first();
        $articleCronaca = $categoryCronaca->articles()->where('published', '1')->orderBy('updated_at', 'DESC')->limit(3)->get();

        // $articles = Category::with('articles')->get();
      
        $data = [
            'articlePolitica' => $articlePolitica,
            'articleCronaca' => $articleCronaca
        ];

        return view('guest.home', $data);
    }
}
