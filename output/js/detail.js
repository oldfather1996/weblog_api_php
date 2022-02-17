var url = window.location.href;
const getId = url.split('/');
var id = getId[4];
var coursesGetIDAPI = 'http://localhost:8000/post' + '/' + id;

// render Details


$.ajax({
    type: "GET",
    url: coursesGetIDAPI,
    data: [],
    success: function(reponse) {
        if (reponse['image'] != "") {
            $('#data-image').attr("src", reponse['image'])
        }
        $('#data-author').text(reponse['author']),
            $('#data-title').text(reponse['title']),
            $('#data-body').text(reponse['body']),
            $('#data-category_name').text(reponse['category_name'])

    },
    error: function() {
        window.location.href = "/"
    }
})


var url_category = window.location.href;
const getcategory_id = url_category.split('/');
var category_id = getcategory_id[5];