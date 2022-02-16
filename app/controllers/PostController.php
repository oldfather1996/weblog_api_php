<?php

namespace app\controllers;

use app\config\Database;

require_once(dirname(__FILE__) . '../../config/Database.php');
require_once(dirname(__FILE__) . '../../models/Post.php');

use app\models\Post;
use PDO;

class PostController extends BaseController
{
    function __construct()
    {
        // echo " something in homcontroller";
    }
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $database = new Database();
        $db = $database->connect();

        $post = new Post($db);

        $result = $post->read();
        $num = $result->rowCount();

        if ($num > 0) {
            $posts_arr = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'author' => $author,
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                    'image' => $image
                );

                array_push($posts_arr, $post_item);
            }

            echo json_encode($posts_arr);
        } else {
            echo json_encode(
                array('message' => 'No Posts Found')
            );
        }
    }
    public function create()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $database = new Database();
        $db = $database->connect();

        $post = new Post($db);

        $data = json_decode(file_get_contents("php://input"));

        $post->title = $data->title;
        $post->body = $data->body;
        $post->author = $data->author;
        $post->category_id = $data->category_id;
        $post->image = $data->image;

        if ($post->create()) {
            echo json_encode(
                array('message' => 'Post Created')
            );
        } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
    }
    public function readSingle()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');


        $database = new Database();
        $db = $database->connect();
        $post = new Post($db);
        $url = $_SERVER['REQUEST_URI'];
        $getId = explode('/', $url);
        $post->id = $getId[2];
        // $post->id = isset($_GET['id']) ? $_GET['id'] : die();



        $post->read_single();

        $post_arr = array(
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'author' => $post->author,
            'category_id' => $post->category_id,
            'category_name' => $post->category_name,
            'image' => $post->image
        );

        print_r(json_encode($post_arr));
    }

    function getPostById()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $database = new Database();
        $db = $database->connect();
        $post = new Post($db);
        $url = $_SERVER['REQUEST_URI'];
        $getId = explode('/', $url);
        $post->category_id = $getId[4];



        // $post->get_post_by_category();
        // $post_arr = array(
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'body' => $post->body,
        //     'author' => $post->author,
        //     'category_id' => $post->category_id,
        //     'category_name' => $post->category_name,
        //     'image' => $post->image
        // );

        // print_r(json_encode($post_arr));

        $result = $post->get_post_by_category();
        $num = $result->rowCount();

        if ($num > 0) {
            $posts_arr = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'body' => html_entity_decode($body),
                    'author' => $author,
                    'category_id' => $category_id,
                    'category_name' => $category_name,
                    'image' => $image
                );

                array_push($posts_arr, $post_item);
            }

            echo json_encode($posts_arr);
        } else {
            echo json_encode(
                array('message' => 'No Posts Found')
            );
        }
    }


    public function delete()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


        $database = new Database();
        $db = $database->connect();

        $post = new Post($db);

        $data = json_decode(file_get_contents("php://input"));

        $url = $_SERVER['REQUEST_URI'];
        $getId = explode('/', $url);
        $post->id = $getId[4];

        if ($post->delete()) {
            echo json_encode(
                array('message' => 'Post Deleted')
            );
        } else {
            echo json_encode(
                array('message' => 'Post Not Deleted')
            );
        }
    }
    public function update()
    {
        $database = new Database();
        $db = $database->connect();

        $post = new Post($db);

        $data = json_decode(file_get_contents("php://input"));

        $url = $_SERVER['REQUEST_URI'];
        $getId = explode('/', $url);
        $post->id = $getId[4];
        // $post->id = isset($_GET['id']) ? $_GET['id'] : die();

        $post->title = $data->title;
        $post->body = $data->body;
        $post->author = $data->author;
        $post->category_id = $data->category_id;
        $post->image = $data->image;
        if ($post->update()) {
            echo json_encode(
                array('message' => 'Post Updated')
            );
        } else {
            echo json_encode(
                array('message' => 'Post Not Updated')
            );
        }
    }
}
