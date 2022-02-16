<?php

namespace app\core;


require_once(dirname(__FILE__) . '/Router.php');
require_once(dirname(__FILE__) . '../../controllers/HomeController.php');
require_once(dirname(__FILE__) . '../../controllers/PostController.php');
require_once(dirname(__FILE__) . '../../controllers/CategoryController.php');
require_once(dirname(__FILE__) . '../../controllers/AdminController.php');





// Layout

Router::get('/', 'HomeController@index');
Router::get('/admin', 'HomeController@Dashbroad');
Router::get('/admin/post', 'HomeController@create');
Router::get('/admin/post/{id}', 'HomeController@update');
Router::get('/admin/postdashboard', 'HomeController@PostDashborad');
Router::get('/admin/categorydashboard', 'HomeController@CatDashborad');



// Post

Router::get('/api/post', 'PostController@index');
Router::get('/post/{id}', 'PostController@readSingle');

// Admin Post

Router::post('/api/admin/post', 'PostController@create');
Router::put('/api/admin/post/{id}', 'PostController@update');
Router::delete('/api/admin/post/{id}', 'PostController@delete');

// Category

Router::get('/api/category', 'CategoryController@index');
Router::get('/api/category/{id}', 'CategoryController@readSingle');

//admin Category
Router::post('/api/admin/category', 'CategoryController@create');
Router::put('/api/admin/category/{id}', 'CategoryController@update');
Router::delete('/api/admin/category/{id}', 'CategoryController@delete');


// $this->router->post('/signup', 'AdminController@signup');
// $this->router->put('/admin/{id}', 'AdminController@update');





$router = new Router;

try {
    $route = $router->getRoute();
} catch (\Exception $exception) {
    echo $exception->getMessage();
    exit();
}

$route = $router->matchController();
