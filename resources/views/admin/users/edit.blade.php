@extends('layouts.admin')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    You have some errors
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif

<h2 class="mb-4 fs-3">Update Password</h2>
{{dd($user->id)}}
<form action="{{route('users.update' , $user->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="password" name="password" value="{{$user->password}}" placeholder="new password">
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="password" name="password" value="{{$user->password}}" placeholder="confirm password">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>


</form>

@endsection