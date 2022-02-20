<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBroad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/mini.min.css">
    <link rel="stylesheet" href="../../font/css/all.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../assetTemplate/css/my.css">
    <?php require_once dirname(__FILE__) . './../theme/header.php' ?>
</head>

<body>
    <div class="continer-fluid">
        <h1><em class="fa fa-check-circle"></em> WELCOME To DashBroad</h1>
        <div class="container_fluid__inside">
            <div class="left">
                <div class="left__dashboard">
                    <p class="left__dashboard-text">
                    Dashboard
                    </p>
                </div>
                <ul>
                    <li>
                        <a href="/admin/postdashboard" class="left__post">
                            <span class="left__post-text">
                                post
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/categorydashboard" class="left__category">
                            <span class="left__category-text">
                                category
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>body</th>
                            <th>image</th>
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
        </div>
    </div>
    <script src="../../js/dashbroad.js"></script>
    <?php require_once dirname(__FILE__) . './../theme/footer_script.php' ?>
</body>

</html>