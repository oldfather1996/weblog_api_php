var coursesGetAllAPI = 'http://localhost:8000/api/post/';
var getCategory = 'http://localhost:8000/api/category';

function start() {
    getCourses(function(courses) {
        renderCourses(courses, 1)
    }, 1);
    getCoursesCat(function(catCourses) {
        renderCatCourses(catCourses)
    });
}
start();

function getCourses(callback, page) {
    fetch(coursesGetAllAPI + page)
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

function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function renderCourses(courses, page) {
    var listCourseBlock =
        document.querySelector('#list-course');

    var htmls = courses[0].map(function(course) {
        let getContent = document.createElement('div')
        getContent.innerHTML = course.body
        getContent.innerHTML = getContent.innerText
        getContent.innerHTML = getContent.innerText
        let content = getContent.innerText
        return `
        <h3>
        <a href=""> ${course.category_name} </a>
        </h3>
        <div class="col-md-12 border-right">
            <div class="col-md-3">
                <a href="/detail/${course.id}">
                <img class="img-responsive" src="${course.image}" alt="">
                </a>
            </div>
            <div class="col-md-9">
                <h3>${course.title}</h3>
                <p class="demo-here">${content}</p>
                <a class="btn btn-primary" href="detail/${course.id}">Read more... <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
            <div class="break"></div>
        </div>
        `
    });
    let pagination = $('#pagination');
    pagination.children().remove()
    console.log(courses[1])
    for (let i = 1; i <= courses[1]; i++) {
        pagination.append(`<li class="pagination-item  ${page == i ? 'active' : ''}">${i}</li>`)
    }
    listCourseBlock.innerHTML = htmls.join('');

}

$(document).on('click', '.pagination-item', function() {
    let page = $(this).text()
    getCourses(function(courses) {
        renderCourses(courses, page)
    }, page);
})

function renderCatCourses(catCourses) {
    var listCourseBlock =
        document.querySelector('#category_items');
    var htmls = catCourses.data.map(function(catCourses) {
        return `
        <li href="#" class="list-group-item menu1">
        <a href="/post/category/${catCourses.id}">${catCourses.name}</a>
        </li>
        `
    })
    listCourseBlock.innerHTML = htmls.join('');
    var listCourseBlock2 =
        document.querySelector('#category_items-header');
    var htmls = catCourses.data.map(function(catCourses) {
        return `
        <a href="/post/category/${catCourses.id}" class="navbar-brand">${catCourses.name}</a>
        `
    })
    listCourseBlock2.innerHTML = htmls.join('');
}