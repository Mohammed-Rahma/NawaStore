@extends('layouts.admin')

@section('content')
<header class=" mb-4 d-flex">
    <h2 class="mb-4 fs-3">{{$title}} </h2>
    <div class="ml-auto">
        <a href="{{route('products.create')}}" class="btn btn-sm btn-primary">+ Create Product</a>
        <a href="{{route('products.trashed')}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> View Trashed</a>
    </div>
</header>
@if(session()->has('success'))
<div class="alert alert-success mt-2">
    {{session('success')}}
</div>
@endif

<form action="{{URL::current()}}" method="get" class="form-inline">
    <input type="text" name="search" value="{{request('search')}}" class="from-control mr-2 mb-2" placeholder="Search...">

    <select name="category_id" class="from-control mr-2 mb-2">
        <option>All categories</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" @selected(request('category_id') == $category->id)> {{$category->name}}</option>
        @endforeach
    </select>

    <select name="status" class="from-control mr-2 mb-2">
        <option>Status</option>
        @foreach($status_options as $value => $text)
        <option value="{{$value}}" @selected(request('status')==$value)>{{$text}}</option>
        @endforeach
    </select>
    <input type="number" name="price_min" value="{{request('price_min')}}" class="from-control mr-2 mb-2" placeholder="Min Price">
    <input type="number" name="price_max" value="{{request('price_max')}}" class="from-control mr-2 mb-2" placeholder="Max Price">

    <button type="submit" class="btn btn-dark">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Slug</th>
            <th>Status</th>
            <th></th>
            <th></th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->category_name}}</td>
            <td>{{$product->price_formatted}}</td>
            <td>{{$product->slug}}</td>
            <td>{{$product->status}}</td>
            <td>
                <!-- [$product->id] , ['product'=>$product->id ,'action' => 'edit'] -->
                <a href="{{route('products.edit' ,$product->id)}}" class="btn btn-sm btn-outline-dark">
                    <i class="far fa-edit"></i>Edit</a>
            </td>
            <td>
                <form action="{{route('products.destroy' , $product->id )}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>

            <td>
                <a href="{{$product->image_url}}" target="_blank">
                    <img src="{{$product->image_url}}" width="60" alt="">
                </a>
            </td>

            <!-- حقل الصورة القديم 
                <td>
                    @if($product->image)
                    <a href="{{asset('storage/'. $product->image)}}" target="_blank">
                  <img src="{{asset('storage/'. $product->image)}}" width="60" alt=""> الطريقة التانية 
                        <img src="{{ Storage::disk('public')->url($product->image)}}" width="60" alt="">
                    </a>
                    @else
                    <img src="https://placehold.co/100x100" alt="">
                    @endif
                </td> 
                -->

        </tr>
        @endforeach
    </tbody>
</table>
{{$products->links()}}

<!-- <script>
    setTimeout(function(){
        {{session('success')}}
        // alert("رسالتك هنا");
    }, 5000);
</script> -->

@endsection