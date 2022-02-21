var url = window.location.href;
const getId = url.split('/');
var id = getId[4];
var coursesGetIDAPI = 'http://localhost:8000/post' + '/' + id;

// render Details
function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

$.ajax({
    type: "GET",
    url: coursesGetIDAPI,
    data: [],
    success: function(reponse) {
        let contentElement = document.createElement('div')
        contentElement.innerHTML = reponse['body']
        $('#data-author').text(reponse['author'])
        $('#data-title').text(reponse['title'])

        $('#data-body').html(reponse['body'])
        $('#data-body').html($('#data-body').text())
        escapeHtml($('#data-body').html($('#data-body').text()))
        $('#data-category_name').text(reponse['category_name'])

    },
    error: function() {
        window.location.href = "/"
    }
})

var getCategory = 'http://localhost:8000/api/category';

function start() {
    getCoursesCat(function(catCourses) {
        renderCatCourses(catCourses)
    });
}
start();

function getCoursesCat(callback) {
    fetch(getCategory)
        .then(function(response) {
            return response.json();
        })
        .then(callback);
}

function renderCatCourses(catCourses) {

    var listCourseBlock2 =
        document.querySelector('#category_items-header');
    var htmls = catCourses.data.map(function(catCourses) {
        return `
        <a href="/post/category/${catCourses.id}" class="navbar-brand">${catCourses.name}</a>
        `
    })
    listCourseBlock2.innerHTML = htmls.join('');
}