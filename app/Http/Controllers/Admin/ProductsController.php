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
        $categories = Category::all();
        return view('admin.products.create' , [
            'products'=> new Product(),
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name'); 
        $product->slug = $request->input('slug'); 
        $product->category_id = $request->input('category_id'); 
        $product->description = $request->input('description'); 
        $product->short_description = $request->input('short_description'); 
        $product->compare_price = $request->input('compare_price'); 
        $product->save();
        //prg: post redirect get 
        return redirect(route('products.index') , with('success' , "Product {$product->name} created")); // -> get request 
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
        // 1) $product = Product::where('id' , '=' , $id)->first();
        // 2) $product = Product::find($id);
        // 3) if(!$product){
        //     abort(404);
        // }
        $product = Product::findOrfail($id); 
        $categories = Category::all();

        return view('admin.products.edit' , [
            'product'=>$product,
            'categories'=>$categories

        ]);
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrfail($id); 
        $product->name = $request->input('name'); 
        $product->slug = $request->input('slug'); 
        $product->category_id = $request->input('category_id'); 
        $product->description = $request->input('description'); 
        $product->short_description = $request->input('short_description'); 
        $product->compare_price = $request->input('compare_price'); 
        $product->save();
        return redirect()->route('products.index')-> with('success' , "Product {$product->name} updated"); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Product::destroy($id);
        // Product::where('id' , '=' , $id)->delete();
        $product = Product::findOrfail($id); 
        $product->delete();
        return redirect()->route('products.index')-> with('success' , "Product {$product->name} deleted"); 
    }
}
