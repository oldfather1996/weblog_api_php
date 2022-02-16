<?php

namespace app\controllers;

use app\config\Database;
use app\models\user;

require_once(dirname(__FILE__) . '../../config/Database.php');
require_once(dirname(__FILE__) . '../../models/Post.php');
require_once(dirname(__FILE__) . '../../models/User.php');


use PDO;

class AdminController
{
    function __construct()
    {
        // echo " something in homcontroller";
    }
    public function signup()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);

        $data = json_decode(file_get_contents("php://input"));
        $user->username = $data->username;
        $user->password = base64_encode($data->password);
        $user->email = $data->email;

        if ($user->signup()) {
            echo json_encode(
                array(
                    'status' => true,
                    'message' => 'User Created',
                    'username' => $user->username
                )
            );
        } else {
            echo json_encode(
                array('message' => 'User Not Created')
            );
        }
    }
    public function login()
    {
        require_once(dirname(__FILE__) . '../../views/Auth/login.php');
    }
    // public function update()
    // {
    //     $database = new Database();
    //     $db = $database->connect();

    //     $post = new Post($db);

    //     $data = json_decode(file_get_contents("php://input"));

    //     $url = $_SERVER['REQUEST_URI'];
    //     $getId = explode('/', $url);
    //     $post->id = $getId[4];
    //     // $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    //     $post->title = $data->title;
    //     $post->body = $data->body;
    //     $post->author = $data->author;
    //     $post->category_id = $data->category_id;

    //     if ($post->update()) {
    //         echo json_encode(
    //             array('message' => 'Post Updated')
    //         );
    //     } else {
    //         echo json_encode(
    //             array('message' => 'Post Not Updated')
    //         );
    //     }
    // }
    function doLogin()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: GET');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);
        $data = json_decode(file_get_contents("php://input"));
        $stmt = $user->doLogin();
        if ($stmt->rowcount() === 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_arr = array(
                'status' => true,
                'message' => 'Login success',
                'username' => $row['username']
            );
        } else {
            $user_arr = array(
                'status' => false,
                'message' => 'false',
                'username' => "invalid username or password"
            );
        }
    }
}
