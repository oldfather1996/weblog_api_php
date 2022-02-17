<?php

namespace app\views\category;
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
            <h1><em class="fa fa-pen-square"></em>Create Category</h1>
            <div>
                <label>name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div>
                <button id="create" class="btn btn-primary">Create</button>
            </div>
        </div>
    </body>
</body>
<script>
    var coursesCreateAPI = 'http://localhost:8000/api/admin/category';

    function start() {
        // getCourses(function(courses) {
        //     renderCourses(courses)
        // });
        handleCreateForm();
    }
    start();

    function createCourse(data, callback) {
        var options = {
            method: 'POST',
            body: JSON.stringify(data)
        }
        fetch(coursesCreateAPI, options)
            .then(function(response) {
                response.json
            })
            .then(callback);;
    }

    function renderCourses(courses) {

    }


    function handleCreateForm() {
        var createBtn = document.querySelector('#create');
        createBtn.onclick = function() {
            var name = document.querySelector('input[name="name"]').value;
            var formData = {
                name: name,
            }
            createCourse(formData, function() {
                getCourses(renderCourses);
            })
            window.location = ('http://localhost:8000/admin/categorydashboard');
        }
    }
</script>

</html>