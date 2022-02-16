var coursesGetAllAPI = 'http://localhost/project/post';
// var coursesCreateAPI = 'http://localhost/assignment/api/post/create.php';
// var coursesUpdateAPI = 'http://localhost/assignment/api/post/update.php';
// var coursesDeleteAPI = 'http://localhost/assignment/api/post/delete.php';
// var coursesGetIDAPI = 'http://localhost/assignment/api/post/read_single.php';

function start() {
    getCourses(function(courses) {
        renderCourses(courses)
        handleCreateForm();
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

function deleteCourse(data) {
    var options = {
        method: 'DELETE',
        body: JSON.stringify(data)
    }
    fetch(coursesDeleteAPI, options)
        .then(function(response) {
            response.json
        })
        .then(callback);;
}

// render all

function renderCourses(courses) {
    var listCourseBlock =
        document.querySelector('#list-course');
    var htmls = courses.map(function(course) {
        return `
    <li>
    <h4>${course.id}</h4>
    <h4>${course.title}</h4>
    <p>${course.body}</p>
    <p>${course.author}</p> 
    <p>${course.category_id}</p> 
    <p>${course.category_name}</p> 
    `
    });
    listCourseBlock.innerHTML = htmls.join('');
}

// handle form data

// function handleCreateForm() {
//     var createBtn = document.querySelector('#create');
//     createBtn.onclick = function() {
//         var title = document.querySelector('input[name="title"]').value;
//         var body = document.querySelector('input[name="body"]').value;
//         var author = document.querySelector('input[name="author"]').value;
//         var category_id = document.querySelector('input[name="category_id"]').value;
//         // var category_name = document.querySelector('input[name="category_name"]').value;
//         var formData = {
//             title: title,
//             body: body,
//             author: author,
//             category_id: category_id,
//         }
//         createCourse(formData, function() {
//             getCourses(renderCourses);
//         })
//     }
// }

function handleDelete() {
    var btnDelete = document.querySelector('#btnDelete');
    btnDelete.onclick = function() {
        var id = document.querySelector()
    }
}