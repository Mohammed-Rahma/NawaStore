<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        return Product::with(['user', 'category', 'gallery']) //return jason formatted data 
            ->filter($request->query())
            ->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        ////// صلاحية التوكن : تستخدم للربط مع تطبيقات خارجية زي لمن افوت ع موقع واسجل حسابي من خلال حساب فيسبوك
        $user = $request->user('sanctum');
        if (!$user->tokenCan('products.create')) { //هل التوكن بقدر ينشا منتج .اذا م كان معه الصلاحية يطلعله رسالة 403
            abort(403);
        }
        
        //لو بدي ابني إ بي اي لنفس الموقع مش لازم صلااحيات ع التوكن بعمل صلاحيات ع اليوزر 

        // $user =$request->user('sanctum');
        // if(!$user->can('products.create')){ //هل التوكن بقدر ينشا منتج .اذا م كان معه الصلاحية يطلعله رسالة 403
        //     abort(403);
        // }

        $data = $request->validated();
        //mass assignment هنا عملية ال 
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('image') as $file) {  //return  array of uploaded file 
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public')
                ]);
            }
        }
        return $product;
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::with('user', 'category', 'gallery')->findorfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = $request->user('sanctum');
        if (!$user->tokenCan('products.update')) {
            abort(403);
        }


        $data = $request->validate([

            'name' => ['sometimes', 'required'],
            'category_id' => ['sometimes', 'required'],
            'price' => ['sometimes', 'required', 'numric', 'min:0']
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image'); //return uploaded file object
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $old_image = $product->image;
        $product->update($data);

        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
        }
        $data['user_id'] = Auth::id();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {  //return  array of uploaded file 
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/images', 'public')
                ]);
            }
        }

        return [
            'message' => 'Product Updated',
            'product' => $product
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        $user = $request->user('sanctum');
        if (!$user->tokenCan('products.delete')) {
            return response([
                'message' => 'Forbidden'
            ], 403);
            // abort(403);
        }

        $product->delete();
        return [
            'message' => 'Product Deleted'
        ];
    }
}
