<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        // dd($category);
        // dd($request->all());
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $newCategory = new Category;
        $newCategory->name = $data['name'];
        $newCategory->user_id = $userId;
        $saved = $newCategory->save();
        
        if (!$saved) {
            return redirect()->back();
        }

        return redirect()->route('admin.categories.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(empty($category)) {
            abort('404');
        }

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (empty($category)) {
            abort('404');
        }

        if (Auth::id() != $category->user_id) {
            abort('404');
        }

        // dd($category);
        // dd($request->all());
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        
        $category->name = $data['name'];
        // $category->fill($data);
        $updated = $category->update();
        if(!$updated) {
            return redirect()->back();
        }

        return redirect()->route('admin.categories.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1) {
            abort('404');
        }
        $category = Category::find($id);
        // dd($id);
        if(empty($category)){
            abort('404');
        }

        if(Auth::id() != $category->user_id) {
            abort('404');
        }

        //se ho degli articoli che usano questa categoria devo prima slegarli 
        $articles = $category->articles;

        foreach ($articles as $article) {
            $article->category_id = 1;
            $article->update();
        }

        $deleted = $category->delete();

        if(!$deleted) {
            foreach ($articles as $article) {
                $article->category_id = $id;
                $article->update();
            }
        }

        return redirect()->route('admin.categories.index');
    }
}
