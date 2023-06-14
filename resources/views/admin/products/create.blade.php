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
        <h2 class="mb-4 fs-3"> <?= $title ?> </h2>



    <form action="" method="post">
    <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="Product Name">
            <label for="Product Name">Product Name</label>
        </div>
        <div class="form-floating">
            <input type ="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

    </div>

    </form>



</body>

</html>