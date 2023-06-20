

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
<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="name">Product Name</label>
            <div>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $product->name) }}" placeholder="Name">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="slug">URL Slug</label>
            <div>
                <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Slug">
                @error('slug')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="description">Description</label>
            <div>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    placeholder="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="short_description">Short description</label>
            <div>
                <textarea type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                    name="short_description" placeholder="short_description">{{ old('short_description', $product->short_description) }} </textarea>
                @error('short_description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="status">Status</label>
            <div>
                <select type="text" class="form-control @error('status') is-invalid @enderror" id="status"
                    name="status" placeholder="status">
                    <option></option>
                    @foreach ($status_options as $key => $value)
                        <option @selected(old('status', $product->status)) value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="category_id">Category</label>
            <div>
                <select type="text" class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                    name="category_id" placeholder="category_id">
                    <option></option>
                    @foreach ($categories as $category)
                        <option @selected($category->id == old('category_id', $product->category_id)) value="{{ $category->id }}">{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="price">Price</label>
            <div>
                <input type="number" step="0.1" min="0"
                    class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    value="{{ old('price', $product->price) }}" placeholder="price">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="compare_price">Compare Price</label>
            <div>
                <input type="number" step="0.1" min="0"
                    class="form-control @error('compare_price') is-invalid @enderror" id="compare_price"
                    name="compare_price" value="{{ old('compare_price', $product->compare_price) }}"
                    placeholder="compare_price">
                @error('compare_price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="image">Image</label>
            <div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Product Image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $submit_label ?? 'Save' }}</button>





<!-- 
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
<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="name">Product Name</label>
            <div>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $product->name) }}" placeholder="Name">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="slug">URL Slug</label>
            <div>
                <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug"
                    name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Slug">
                @error('slug')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="description">Description</label>
            <div>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    placeholder="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="short_description">Short description</label>
            <div>
                <textarea type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                    name="short_description" placeholder="short_description">{{ old('short_description', $product->short_description) }} </textarea>
                @error('short_description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="status">Status</label>
            <div>
                <select type="text" class="form-control @error('status') is-invalid @enderror" id="status"
                    name="status" placeholder="status">
                    <option></option>
                    @foreach ($status_options as $key => $value)
                        <option @selected(old('status', $product->status)) value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="category_id">Category</label>
            <div>
                <select type="text" class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                    name="category_id" placeholder="category_id">
                    <option></option>
                    @foreach ($categories as $category)
                        <option @selected($category->id == old('category_id', $product->category_id)) value="{{ $category->id }}">{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="price">Price</label>
            <div>
                <input type="number" step="0.1" min="0"
                    class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    value="{{ old('price', $product->price) }}" placeholder="price">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="compare_price">Compare Price</label>
            <div>
                <input type="number" step="0.1" min="0"
                    class="form-control @error('compare_price') is-invalid @enderror" id="compare_price"
                    name="compare_price" value="{{ old('compare_price', $product->compare_price) }}"
                    placeholder="compare_price">
                @error('compare_price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-floating mb-3">
            <label for="image">Image</label>
            <div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                    name="image" placeholder="Product Image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $submit_label ?? 'Save' }}</button> -->