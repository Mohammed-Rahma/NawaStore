<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //using query builder 
        // $products= DB::table('products')->
        // join('categories' , 'categories.id' , '=' , 'products.category_id')
        // ->select([
        //     'products.*',
        //     'categories.name as category_name'
        // ])-> get(); // return collection of std object (array) 

        //using model 
        $products = Product::leftjoin('categories' , 'categories.id' , '=' , 'products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name'
        ])-> get(); // return collection of product model
        
        return view('admin.products.index',[
            'title'=>'Products List',
            'products'=>$products
        ]);
        
        //SELECT * FROM products
        // $product = Category::all();
        // $products = Product::all()
        // $products = Product::get()
        // dd($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name'); 
        $product->slug = $request->input('slug'); 
        $product->description = $request->input('description'); 
        $product->short_description = $request->input('short_description'); 
        $product->compare_price = $request->input('compare_price'); 
        $product->save();
        //prg: post redirect get 
        return redirect(route('products.index')); // -> get request 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
