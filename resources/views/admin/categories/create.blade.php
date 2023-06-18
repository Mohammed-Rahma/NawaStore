@extends('layouts.admin')
@section('content')

<h2 class="mb-4 fs-3">New Categories</h2>
<form action="{{route('categories.store')}}" method="post">
    @csrf
    <!-- <?= csrf_field() ?> -->
    <!-- <input type="hidden" name="_token" value="<?= csrf_field() ?>"> -->

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
        <label for="name">Category Name</label>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
@endsection