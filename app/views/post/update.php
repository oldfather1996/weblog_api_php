<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1><em class="fa fa-pen-square"></em>Update</h1>
        <div>
            <label for="name">title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div>
            <label for="name">body</label>
            <input type="text" class="form-control" name="body">
        </div>
        <div>
            <label for="name">author</label>
            <input type="text" class="form-control" name="author">
        </div>
        <div>
            <label for="name">category_id</label>
            <input type="number" class="form-control" name="category_id">
        </div>
        <div>
            <label>image</label>
            <input type="text" class="form-control" name="image">
        </div>
        <div>
            <button id="btnUpdate" class="btn btn-primary">update</button>
        </div>
    </div>

</body>
<script src="../../js/update.js"></script>

</html>