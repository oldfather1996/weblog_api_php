    var coursesGetAllAPI = 'http://localhost:8000/api/post';
    // var coursesCreateAPI = 'http://localhost/project/admin/post';
    var coursesUpdateAPI = 'http://localhost:8000/admin/post/';
    var coursesDeleteAPI = 'http://localhost:8000/admin/post/';
    var coursesGetIDAPI = 'http://localhost:8000/api/post/';

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
            document.querySelector('#list-course');
        var htmls = courses.map(function(course) {
            let getContent = document.createElement('div')
            getContent.innerHTML = course.body
            getContent.innerHTML = getContent.innerText
            getContent.innerHTML = getContent.innerText
            let content = getContent.innerText
            return `
                <tr>
            <td><span class="title">${course.title}</span></td>
            <td><span class="list__course--body">${content}</span> </td>   
            <td><img class="list__course--image" src="${course.image}"></img> </td>   
            <td><span class="author">${course.author}</span></td>
            <td><span class="category_id">${course.category_id}</span></td>
            <td><span class="category_name">${course.category_name}</span></td>    
            <td>
            <a href="./post/${course.id}" ><em class="fa fa-pen-square fa-2x"></em></a>
            <a type="button" class="text-danger" id="btnDelete" onclick="handleDeleteCourse(${course.id}) "><em class="fa fa-trash fa-2x"></em></a>
            <a href="/post/${course.id}" type="button" ">Details</a></td>
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