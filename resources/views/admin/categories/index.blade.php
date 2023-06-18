@extends('layouts.admin')
@section('content')
        <h2 class="mb-4 fs-3">{{$title}}</h2>
        <a href="{{ route('categories.create')}}" class="btn btn-sm btn-primary">+ Create Categories</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>

                        <td>
                <!-- [$product->id] , ['product'=>$product->id ,'action' => 'edit'] -->
                    <a href="{{route('categories.edit' ,$category->id)}}" class="btn btn-sm btn-outline-dark">
                        <i class="far fa-edit"></i>Edit</a>
                </td>
                <td>
                    <form action="{{route('categories.destroy' , $category->id )}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>

                    </tr>
                    @endforeach
            </tbody>
        </table>
@endsection