<div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" value="{{$product->name}}" name="name" placeholder="ProductName">
        <label for="name">Product Name</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="slug" value="{{$product->slug}}" name="slug" placeholder="URL Slug">
        <label for="slug">URL Slug</label>
    </div>

    <select name="category_id" id="category_id" class="form-select form-control">
            @foreach($categories as $category)
            <option @selected(category->id ==$product->category_id) value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        
    <div class="form-floating mb-3">
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Description">{{$product->description}}</textarea>
        <label for="description">Description</label>
    </div>

    <div class="form-floating mb-3">
        <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="Description"> {{$product->short_description}} </textarea>
        <label for="short_description">Short Description</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" value="{{$product->price}}" id="price" name="price" placeholder="price">
        <label for="price">Product Price</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="compare_price" value="{{$product->compare_price}}" name="compare_price" placeholder="compare_price">
        <label for="compare_price">compare price</label>
    </div>

    <div class="form-floating mb-3">
        <input type="file" class="form-control" id="image" name="image" placeholder="image">
        <label for="image">image</label>
    </div>
    <button type="submit" class="btn btn-success">{{$submit_labal ?? 'save'}}</button>