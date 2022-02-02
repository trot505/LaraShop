<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Storage;

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
        $categories = Category::orderByDesc('id')->with('products')->paginate(30);
        $title = $this->titleDefault;
        return view('pages.categories', compact('title', 'categories'));
    }

    public function productList (Category $category)
    {
        $products = $category->products;
        $title = "Спсиок товаров для категории $category->name";
        return view('pages.products', compact('title', 'products'));
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
        //if(!Auth::user()->is_admin) return redirect()->route('home');
        $request->validate([
            'name' => 'required',
            'picture' => "mimetypes:image/*"
        ]);

        $r = $request->all();
        $picture = $request->file('picture') ?? null;

        if ($picture){
            $path = $picture->store(config('my.images_product'));
            $r['picture'] = pathinfo($path, PATHINFO_BASENAME);
        }

        Category::create($r);

        return redirect()->route('pages.categories');
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
        $title = 'Реадктирование категории';
        return view('admin.pages.category-form', compact('title', 'category'));
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
        $request->validate([
            'name' => 'required',
            'picture' => "mimetypes:image/*"
        ]);

        $r = [
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? null,
        ];
        $picture = $request->file('picture') ?? null;
        if ($picture){
            $path = $picture->store(config('my.images_product'));
            if($category->picture !== 'no_picture.png') Storage::delete(config('my.images_product').$category->picture);
            $r['picture'] = pathinfo($path, PATHINFO_BASENAME);
        }

        $category->update($r);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
