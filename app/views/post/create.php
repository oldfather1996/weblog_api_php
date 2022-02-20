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
                <label>title : </label>
                <input type="text" class="form-control" name="title">
            </div>
            <div>
                <label>body : </label>
                <input type="text" class="form-control" name="body" id="content">
            </div>
            <div>
                <label>author : </label>
                <input type="text" class="form-control" name="author">
            </div>
            <div>
                <label>category_id : </label>
                <!-- <input type="number" class="form-control" name="category_id"> -->
                <select name="" id="select-option" name="category_id">
                </select>
            </div>
            <div>
                <label>Image : </label>
                <input type="file" class="form-control" id="image">
                <input type="text" hidden name="photo" id="photo">
                <img src="" alt="" id="demo-image">
            </div>
            <div>
                <button id="create" class="btn btn-primary">Create</button>
            </div>
        </div>
    </body>
    <script src="../../assetTemplate/js/jquery.js"></script>
    <script src="../../js/create.js"></script>
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
        $(document).ready(function() {
            $(document).on('change', '#image', function(e) {
                if (e.target.files && e.target.files[0]) {
                    let reader = new FileReader()
                    reader.onload = function(e) {
                        $('#photo').val(e.target.result)
                        $('#demo-image').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(e.target.files[0])
                }
            })
        })
    </script>
</body>

</html>