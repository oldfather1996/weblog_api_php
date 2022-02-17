<?php

namespace app\views\category;
?>

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
            <input type="text" class="form-control" name="name">
        </div>
        <div>
            <button id="categoryUpdate" class="btn btn-primary">update</button>
        </div>
    </div>

</body>
<script>
    var coursesUpdateAPI = 'http://localhost:8000/api/admin/category';
    var coursesGetAllAPI = 'http://localhost:8000/api/post';

    function start() {
        getCourses(function(courses) {});
        handleUpdateCourse();
    }
    start();

    function getCourses(callback) {
        fetch(coursesGetAllAPI)
            .then(function(response) {
                return response.json();
            })
            .then(callback);
    }

    function updateCourse(id, data) {
        var options = {
            method: 'PUT',
            body: JSON.stringify(data)
        }
        fetch(coursesUpdateAPI + '/' + id, options)
            .then(function(response) {
                response.json
            })
            .then(function() {});;

        function renderCourses(courses) {}
    }

    function handleUpdateCourse() {
        var updateBtn = document.querySelector('#categoryUpdate');
        updateBtn.onclick = function() {
            var url = window.location.href;
            const getId = url.split('/');
            var id = getId[5];
            console.log(id)
            var name = document.querySelector('input[name="name"]').value;
            // var category_name = document.querySelector('input[name="category_name"]').value;
            var formData = {
                name: name,
            }
            updateCourse(id, formData, function() {
                getCourses(renderCourses);
            })
            window.location = ('http://localhost:8000/admin/categorydashboard');
        }
    }
</script>

</html>