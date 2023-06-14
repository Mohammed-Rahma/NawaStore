<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <h2 class="mb-4 fs-3">New Product</h2>
        <form action="<?= route('products.store')?>" method="post">
          
        <?= csrf_field()?>
        <!-- <input type="hidden" name="_token" value="<?= csrf_field() ?>"> -->
        
        <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                <label for="name">Product Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="slug" name="slug" placeholder="URL Slug">
                <label for="slug">URL Slug</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                <label for="description">Description</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description"></textarea>
                <label for="short_description">Short Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="price" name="price" placeholder="Product Price">
                <label for="price">Product Price</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="compare_price" name="compare_price" placeholder="Compare Price">
                <label for="compare_price">Compare Price</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="image" name="image" placeholder="Product Image">
                <label for="image">Product Image</label>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
    </div>

    </form>



</body>

</html>