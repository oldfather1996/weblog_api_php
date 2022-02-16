<?php

namespace app\views\category;
?>
<script src="../../output/js/update.js"></script>
<?php require_once dirname(__FILE__) . '../../theme/header.php' ?>
<?php require_once dirname(__FILE__) . '../../theme/header_script.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../output/font/css/all.css">
    <link rel="stylesheet" href="../../output/font/css/mini.min.css">
</head>

<body>
    <div class="container-fluid">
        <h1><em class="fa fa-pen-square"></em>Update</h1>
        <div>
            <label for="name">category</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div>
            <button id="btnUpdate" class="btn btn-primary">update</button>
        </div>
    </div>
    <?php require_once dirname(__FILE__) . '../../theme/footer_script.php' ?>

</body>

</html>