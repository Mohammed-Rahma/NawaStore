<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
   
    public function __construct(Request $request)
    {
        if($request->method() == 'GET'){
            $categories = Category::all();
            View::share([
                'categories'=>$categories,
                'status_options'=>Product::statusOptions(),
            ]);
        }

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        ])
        ->filter($request->query())
        ->Paginate(5); // return collection of product model
        //  ->Active();
        // ->Status('archived')
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
        return view('admin.products.create' , [
            'product'=> new Product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
    //    $rulls=[
    //     'name'=>'required|max:255|min:3',
    //     'slug'=>'required|unique:products',
    //     'category_id'=>'nullable|int|exists:categories,id',
    //     'description'=>'nullable|string',
    //     'short_description'=>'nullable|string',
    //     'price'=>'required|numeric|min:0',
    //     'compare_price'=>'nullable|numeric|main:0|gt:price',
    //     'image'=>'image|dimensions:min_width=400,min_height=300|max:500'
    //     // 'image'=>'image|mimetype:image/png,image/jpg'

    //    ];
    //     $request->validate($rulls);

        // $product = new Product(); انشا مودل جديد للبرودكت 
        // $product->name = $request->input('name'); 
        // $product->slug = $request->input('slug'); 
        // $product->category_id = $request->input('category_id'); 
        // $product->description = $request->input('description'); 
        // $product->short_description = $request->input('short_description'); 
        // $product->price = $request->input('price'); 
        // $product->compare_price = $request->input('compare_price'); 
        // $product->save();
        //prg: post redirect get 



        //mass assignment هنا عملية ال 
        $data=$request->validated();
        if($request->hasFile('image')){
           $file = $request->file('image');
            $path = $file->store('uploads/images' , 'public');
            $data['image']=$path;
        }
        $data['user_id']=Auth::id();
        $product = Product::create($data);

        if($request->hasFile('gallery')){
            foreach ($request->file('image') as $file){  //return  array of uploaded file 
              ProductImage::create([
                'product_id'=>$product->id,
                'image'=> $file->store('uploads/images','public')
              ]);
            }

        }
        return redirect(route('products.index'))->with('success' , "Product ({$product->name}) created"); // -> get request 
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
    public function edit(Product $product)
    {
        // 1) $product = Product::where('id' , '=' , $id)->first();
        // 2) $product = Product::find($id);

        // 3) if(!$product){abort(404);}   =  $product = Product::findOrfail($id); 

        $gallery = ProductImage::where('product_id', '=' , $product->id)->get();
        return view('admin.products.edit' , [
            'product'=>$product,
            'gallery'=>$gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(ProductRequest $request, Product $product)
    {
        // $rulls=[
        //     'name'=>'required|max:255|min:3',
        //     'slug'=>"required|unique:products,slug,$id",
        //     'category_id'=>'nullable|int|exists:categories,id',
        //     'description'=>'nullable|string',
        //     'short_description'=>'nullable|string',
        //     'price'=>'required|numeric|min:0',
        //     'compare_price'=>'nullable|numeric|main:0|gt:price',
        //     'image'=>'image|dimensions:min_width=400,min_height=300|max:500'
        //     // 'image'=>'image|mimetype:image/png,image/jpg'
    
        //    ];
        //     $request->validate($rulls);
               

        // $product = Product::findOrfail($id); بتعامل مع نفس البرودكت الحالي 
        // $product->name = $request->input('name'); 
        // $product->slug = $request->input('slug'); 
        // $product->category_id = $request->input('category_id'); 
        // $product->description = $request->input('description'); 
        // $product->short_description = $request->input('short_description'); 
        // $product->price = $request->input('price'); 
        // $product->compare_price = $request->input('compare_price'); 
        // $product->save();

        // $product = Product::findOrfail($id); 
        $data = $request->validated();
        if($request->hasFile('image')){
            $file = $request->file('image'); //return uploaded file object
            $path = $file->store('uploads/images','public');
            $data['image'] = $path;
        }
        $old_image = $product->image;
        $product->update($data);

        if($old_image && $old_image != $product->image ){Storage::disk('public')->delete($old_image);}
        $data['user_id'] = Auth::id();

        if($request->hasFile('gallery')){
            foreach ($request->file('gallery') as $file){  //return  array of uploaded file 
              ProductImage::create([
                'product_id'=>$product->id,
                'image'=> $file->store('uploads/images','public')
              ]);
            }

        }

        return redirect()->route('products.index')-> with('success' , "Product ({$product->name}) updated"); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Product::destroy($id);  او  Product::where('id' , '=' , $id)->delete();

        //Product::delete(); تحذف كل البيانات 
        // $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')-> with('success' , "Product ({$product->name}) deleted"); 
    }

    public function trashed(){

        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trashed' , [
            'title'=> 'Trashed Products',
            'products' => $products
        ]);
    }

    public function restore($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.index')-> with('success' , "Product ({$product->name}) restore"); 
    }
    
    public function forceDelete($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        if($product->image){ Storage::disk('public')->delete($product->image);}

        return redirect()->route('products.index')-> with('success' , "Product ({$product->name}) deleted forever!"); 
    }


}
