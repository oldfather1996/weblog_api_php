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

function getCourses(callback) {
    fetch(coursesGetAllAPI)
        .then(function(response) {
            return response.json();
        })
        .then(callback);
}

function getCoursesCat(callback) {
    fetch(getCategory)
        .then(function(response) {
            return response.json();
        })
        .then(callback);
}

function renderCourses(courses) {
    var listCourseBlock =
        document.querySelector('#list-course');
    var htmls = courses.map(function(course) {
        return `
        <h3>
        <a href="#"> ${course.category_name} </a>
        </h3>
        <div class="col-md-12 border-right">
            <div class="col-md-3">
                <a href="chitiet.html">
                <img class="img-responsive" src="${course.image}" alt="">
                </a>
            </div>
            <div class="col-md-9">
                <h3>${course.title}</h3>
                <p>${course.body}</p>
                <a class="btn btn-primary" href="detail/${course.id}">Details <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
            <div class="break"></div>
        </div>
        `
    });
    listCourseBlock.innerHTML = htmls.join('');
}

function renderCatCourses(catCourses) {
    var listCourseBlock =
        document.querySelector('#category_items');
    var htmls = catCourses.data.map(function(catCourses) {
        return `
        <li href="#" class="list-group-item menu1">
        <a href="#">${catCourses.name}</a>
        </li>
        `
    })
    listCourseBlock.innerHTML = htmls.join('');
}