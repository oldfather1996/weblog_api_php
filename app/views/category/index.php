<?php
 namespace app\views\category;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBroad</title>
    <?php include_once(dirname(__FILE__) . '/theme/header_script.php') ?>;
</head>
<style>
    h1 {
        text-align: center;
    }
</style>

<body>
    <?php require_once dirname(__FILE__) . '/theme/header.php' ?>
    <div class="continer-fluid">
        <h1><em class="fa fa-check-circle"></em> WELCOME To DashBroad</h1>
        <a href="./admin/post">Add</a>
        <table class="table datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>body</th>
                    <th>author</th>
                    <th>catgory_id</th>
                    <th>catgory_name</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody id="list-course">
            </tbody>
        </table>
    </div>
    <?php require_once dirname(__FILE__) . '/theme/footer_script.php' ?>
</body>

</html>