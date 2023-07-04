<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // $categories = Category::
        // select([
        //     'categories.*',
        // ])-> get(); // return collection of product model
       
        $categories = Category::withCount('products')->paginate();
        return view('admin.categories.index' , [
            'title'=>'Categories List',
            'categories'=>$categories
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name'); //اسم العمود في الداتا بيز نفسسس اسم الحقل تاع الفورم 
        $category->save(); //خزن في الداتا بيز 
        //prg: post redirect get 
        return redirect()->route('categories.index')->with('success' , "Category ({$category->name}) created");  
        // redirect(route('categories.index'));
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
        $category = Category::findOrfail($id);
        //if(!$category){abort(404);}  =  ::findOrfail($id);

        return view('admin.categories.edit' ,[
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrfial($id);
        $category->name = $request->input('name'); 
        $category->save();
        //prg: post redirect get 
        return redirect()->route('categories.index')->with('success' , "Category ({$category->name}) updated"); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index');
    }
}
