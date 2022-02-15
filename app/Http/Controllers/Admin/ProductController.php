<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $title = 'Спсиок товаров';
        return view('pages.products', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.product-form', compact('categories'));
    }

    public function createProductCategory(Category $category)
    {
        $category_id = $category->id;
        $categories = Category::all();
        return view('admin.pages.product-form', compact('categories', 'category_id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|integer',
            'price' => 'sometimes|numeric',
            'amount' => 'sometimes|nullable|integer',
            'picture' => "sometimes|mimetypes:image/*"
        ]);

        $r = $request->post();
        $picture = $request->file('picture') ?? null;

        if ($picture){
            $path = $picture->store(config('my.images_product'));
            $r['picture'] = pathinfo($path, PATHINFO_BASENAME);
        }
        Product::create($r);

        session()->flash('successAnswer', 'Товар успешно сохранен.');
        return redirect()->route('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $title = 'Реадктирование товара';
        return view('admin.pages.product-form', compact('title', 'product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|integer',
            'price' => 'sometimes|numeric',
            'amount' => 'sometimes|nullable|integer',
            'picture' => "sometimes|mimetypes:image/*"
        ]);

        $r = [
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ];
        $picture = $request->file('picture') ?? null;

        if ($picture){
            $path = $picture->store(config('my.images_product'));
            if($product->picture !== 'no_picture.png') Storage::delete(config('my.images_product').$product->picture);
            $r['picture'] = pathinfo($path, PATHINFO_BASENAME);
        }

        $product->update($r);
        session()->flash('successAnswer', 'Товар успешно сохранен.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
