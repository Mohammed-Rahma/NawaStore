@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">{{$title}}</h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $users)
        <tr>
            <td>{{$users->id}}</td>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            <td>
                <!-- [$product->id] , ['product'=>$product->id ,'action' => 'edit'] -->
                <a href="{{route('users.edit' ,[$users->id,])}}" class="btn btn-sm btn-outline-dark">
                    <i class="far fa-edit"></i> Update Password</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection