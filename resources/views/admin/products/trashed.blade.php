@extends('layouts.admin')

@section('content')
<header class="mb-4 d-flex">
    <h2 class="mb-4 fs-3">{{$title}} </h2>
    <div class="ml-auto">
        <a href="{{route('products.index')}}" class="btn btn-sm btn-primary"> Product List</a>
    </div>
</header>
@if(session()->has('success'))
<div class="alter alter-success">
    {{session('success')}}
</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Restore</th>
            <th>Delete At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td>
                    <a href="{{$product->image_url}}" target="_blank">
                        <img src="{{$product->image_url}}" width="60" alt="">
                    </a>
                </td>
                <td>{{$product->id}}</td>

                <td>{{$product->name}}</td>

                <td>
                    <form action="{{ route('products.restore', $product->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('products.force-delete', $product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Force Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
{{$products->links()}}

@endsection