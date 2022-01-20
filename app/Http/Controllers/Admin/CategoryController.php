<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $titleDefault = 'Спсиок категорий';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(30);
        $title = $this->titleDefault;
        return view('admin.categories', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Создание категории';
        return view('admin.pages.category-form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->is_admin) return redirect()->route('home');
        $request->validate([
            'name' => 'required',
            'picture' => "mimetypes:image/*"
        ]);

        $r = $request->all();
        $category = new Category();
        $picture = $request->file('picture') ?? null;

        if ($picture){
            $path = $picture->store(config('my.images_product'));
            $category->picture = pathinfo($path, PATHINFO_BASENAME);
        }

        $category->name = $r['name'];
        $category->description = $r['description'];
        $category->save();

        return redirect()->route('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
