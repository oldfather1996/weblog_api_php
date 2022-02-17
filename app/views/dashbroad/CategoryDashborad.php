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
                            <th>id</th>
                            <th>name</th>
                        </tr>
                    </thead>
                    <tbody id="list-course-category">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once dirname(__FILE__) . './../theme/footer_script.php' ?>
</body>
<script>
    var coursesGetAllAPI = 'http://localhost:8000/api/category';
    var coursesUpdateAPI = 'http://localhost:8000/admin/category/';
    var coursesDeleteAPI = 'http://localhost:8000/api/admin/category';
    var coursesGetIDAPI = 'http://localhost:8000/api/category/';

    function start() {
        getCourses(function(courses) {
            renderCourses(courses)
            handleDeleteCourse();
        });
    }
    start();

    // get all data
    function getCourses(callback) {
        fetch(coursesGetAllAPI)
            .then(function(response) {
                return response.json();
            })
            .then(callback);
    }

    // get detail 
    function getCourseID(id) {
        fetch(coursesGetIDAPI + '/' + id)
            .then(function(response) {
                return response.json();
            })
            .then(callback);
    }

    // create new data

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

    // delete data

    function handleDeleteCourse(id) {
        var options = {
            method: 'DELETE',
        }
        fetch(coursesDeleteAPI + '/' + id, options)
            .then(function(response) {
                response.json
            })
            .then(function() {
                getCourses(renderCourses);
            });;
    }

    function updateCourse(id, data) {
        var options = {
            method: 'PATCH',
            body: JSON.stringify(data)
        }
        fetch(coursesUpdateAPI + '/' + id, options)
            .then(function(response) {
                response.json
            })
            .then(function() {
                getCourses(renderCourses);
            });;
    }

    // render all

    function renderCourses(courses) {
        var listCourseBlock =
            document.querySelector('#list-course-category');
        var htmls = courses.data.map(function(course) {
            return `
                <tr>
            <td><span class="title">${course.id}</span></td>
            <td><span class="list__course--body">${course.name}</span> </td>   
            <td>
            <a href="./category/${course.id}" ><em class="fa fa-pen-square fa-2x"></em></a>
            <a type="button" class="text-danger" id="btnDelete" onclick="handleDeleteCourse(${course.id}) "><em class="fa fa-trash fa-2x"></em></a>
            <a href="/api/category/${course.id}" type="button" ">Details</a></td>
            </tr>
            `
        });
        listCourseBlock.innerHTML = htmls.join('');
    }

    // handle form data

    function handleCreateForm() {
        var createBtn = document.querySelector('#create');
        createBtn.onclick = function() {
            var title = document.querySelector('input[name="title"]').value;
            var body = document.querySelector('input[name="body"]').value;
            var author = document.querySelector('input[name="author"]').value;
            var category_id = document.querySelector('input[name="category_id"]').value;
            var formData = {
                title: title,
                body: body,
                author: author,
                category_id: category_id,
            }
            createCourse(formData, function() {
                getCourses(renderCourses);
            })
        }
    }


    function handleUpdateCourse() {
        var createBtn = document.querySelector('#btnUpdate');
        createBtn.onclick = function() {
            var title = document.querySelector('input[name="title"]').value;
            var body = document.querySelector('input[name="body"]').value;
            var author = document.querySelector('input[name="author"]').value;
            var category_id = document.querySelector('input[name="category_id"]').value;
            // var category_name = document.querySelector('input[name="category_name"]').value;
            var formData = {
                title: title,
                body: body,
                author: author,
                category_id: category_id,
            }
            updateCourse(id, formData, function() {
                getCourses(renderCourses);
            })
        }
    }
</script>

</html>