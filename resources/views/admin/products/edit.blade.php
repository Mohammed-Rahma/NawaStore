@extends('layouts.admin')
@section('content')
<form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- 1) <input type="hidden" name="_method" value="put"> -->
    @method('put')
    <h2 class="mb-4 fs-3">Edit product</h2>

    @include('admin.products._form' , [
        'submit_label'=>'Update'
        ])
    </form>
@endsection