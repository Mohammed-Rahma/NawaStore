@extends('layouts.admin')
@section('content')
<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <h2 class="mb-4 fs-3">Create Product</h2>
    @include('admin.products._form' , [
        'submit_labal'=>'Create'
        ])
</form>
@endsection