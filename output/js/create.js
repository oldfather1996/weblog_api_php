var coursesGetAllAPI = 'http://localhost:8000/api/post';
var coursesCreateAPI = 'http://localhost:8000/api/admin/post';
var coursesUpdateAPI = 'http://localhost:8000/admin/post/';
var coursesDeleteAPI = 'http://localhost:8000/admin/post/';
var coursesGetIDAPI = 'http://localhost:8000/api/post/';
var getCategory = 'http://localhost:8000/api/category';

function start() {
    // getCourses(function(courses) {
    //     renderCourses(courses)
    // });

    getCoursesCat(function(catCourses) {
        renderCatCourses(catCourses)
    });
    handleCreateForm();

}
$(document).ready(function() {
    start();

})

function getCoursesCat(callback) {
    fetch(getCategory)
        .then(function(response) {
            return response.json();
        })
        .then(callback);
}


function renderCatCourses(catCourses) {
    var listCourseBlock =
        document.querySelector('#select-option');
    var htmls = catCourses.data.map(function(catCourses) {
        return `
    <option value="${catCourses.id}" >${catCourses.name}</option>
`
    })
    listCourseBlock.innerHTML = htmls.join('');
}

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
    // var listCourseBlock =
    //     document.querySelector('#list-course');
    // var htmls = courses.map(function(course) {
    //     return `
    //         <tr>
    //     <td>${course.id}</td>
    //     <td><span class="title">${course.title}</span></td>
    //     <td><span class="body">${course.body}</span> </td>   
    //     <td><span class="author">${course.author}</span></td>
    //     <td><span class="category_id">${course.category_id}</span></td>
    //     <td><span class="category_name">${course.category_name}</span></td>    
    //     <td>
    //     <a href="./admin/post/${course.id}" ><em class="fa fa-pen-square fa-2x"></em></a>
    //     <a type="button" class="text-danger" id="btnDelete" onclick="handleDeleteCourse(${course.id}) "><em class="fa fa-trash fa-2x"></em></a>
    //     <a href="./post/${course.id}" type="button" ">Details</a></td>
    //     </tr>
    //     `
    // });
    // listCourseBlock.innerHTML = htmls.join('');
}

// handle form data

function handleCreateForm() {

    var createBtn = document.querySelector('#create');
    createBtn.onclick = function() {
        var title = document.querySelector('input[name="title"]').value;
        var body = CKEDITOR.instances['content'].getData();
        var author = document.querySelector('input[name="author"]').value;
        var category_id = $('#select-option').val() ? $('#select-option').val() : 1;
        var image = document.querySelector('input[name="photo"]').value;
        var formData = {
            title: title,
            body: body,
            author: author,
            category_id: category_id,
            image: image
        }
        createCourse(formData, function() {
            getCourses(renderCourses);
        })
        console.log(formData)
        window.location = ('http://localhost:8000/admin/postdashboard');
    }
}