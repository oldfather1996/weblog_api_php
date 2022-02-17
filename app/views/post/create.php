<?php

namespace app\views\post;
?>

<?php require_once dirname(__FILE__) . '../../theme/header_script.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../output/font/css/all.css">
</head>

<body>

    <body>
        <div class="container-fluid">
            <h1><em class="fa fa-pen-square"></em>Create</h1>
            <div>
                <label>title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div>
                <label>body</label>
                <input type="text" class="form-control" name="body">
            </div>
            <div>
                <label>author</label>
                <input type="text" class="form-control" name="author">
            </div>
            <div>
                <label>category_id</label>
                <input type="number" class="form-control" name="category_id">
            </div>
            <div>
                <label>image</label>
                <input type="text" class="form-control" name="image">
            </div>
            <div>
                <button id="create" class="btn btn-primary">Create</button>
            </div>
        </div>
    </body>
    <script src="../../js/create.js"></script>
</body>

</html>