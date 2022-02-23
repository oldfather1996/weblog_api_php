
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
    <link rel="stylesheet" href="../../css/dashboard.css">
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
                <div class="right__post">
                    <div class="right__post--text">
                        Post Total
                    </div>
                    <p id="post_items"></p>
                    <a class="right__post--btn" href="/admin/post">Create Post</a>
                </div>
                <div class="right__category">
                    <div class="right__category--text">
                        Category Total
                    </div>
                    <p id="category_items"></p>
                    <a class="right__post--btn" href="/admin/category">Create Post</a>
                </div>

                <!-- <table class="table datatable">
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
                </table> -->
            </div>
        </div>
    </div>
    <?php require_once dirname(__FILE__) . './../theme/footer_script.php' ?>
</body>
<script>
    var coursesGetAllAPI = 'http://localhost:8000/api/post';
    var getCategory = 'http://localhost:8000/api/category';

    function start() {
        getCourses(function(courses) {
            renderCourses(courses)
        });
        getCoursesCat(function(catCourses) {
            renderCatCourses(catCourses)
        });
    }
    start();
    // get post
    function getCourses(callback) {
        fetch(coursesGetAllAPI)
            .then(function(response) {
                return response.json();
            })
            .then(callback);
    }

    function renderCourses(courses) {
        var listCourseBlock =
            document.querySelector('#post_items');
        var htmls = courses.length
        listCourseBlock.innerText = htmls;
    }

    // get Category

    function getCoursesCat(callback) {
        fetch(getCategory)
            .then(function(response) {
                return response.json();
            })
            .then(callback);
    }

    function renderCatCourses(catCourses) {
        var listCourseBlock =
            document.querySelector('#category_items');
        var htmls = catCourses.data.length
        listCourseBlock.innerText = htmls;
    }
</script>

</html>