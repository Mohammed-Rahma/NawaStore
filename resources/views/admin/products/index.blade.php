@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">{{$title}} </h2>
<a href="{{route('products.create')}}" class="btn btn-sm btn-primary">+ Create Product</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category_name}}</td>
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
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
@endsection