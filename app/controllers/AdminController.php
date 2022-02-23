<?php

namespace app\controllers;

use app\config\Database;
use app\config\JwtHandler;
use app\models\user;

require_once(dirname(__FILE__) . '../../models/User.php');

require_once(dirname(__FILE__).'../../config/JwtHandler.php');


use PDO;
use PDOException;

class AdminController
{
    function __construct()
    {
        // echo " something in homcontroller";
    }
    public function signup()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: POST");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $db_connection = new Database();
        $conn = $db_connection->connect();

        function msg($success, $status, $message, $extra = [])
        {
            return array_merge([
                'success' => $success,
                'status' => $status,
                'message' => $message
            ], $extra);
        }

        // DATA FORM REQUEST
        $data = json_decode(file_get_contents("php://input"));
        $returnData = [];

        if ($_SERVER["REQUEST_METHOD"] != "POST") :

            $returnData = msg(0, 404, 'Page Not Found!');

        elseif (
            !isset($data->name)
            || !isset($data->email)
            || !isset($data->password)
            || empty(trim($data->name))
            || empty(trim($data->email))
            || empty(trim($data->password))
        ) :

            $fields = ['fields' => ['name', 'email', 'password']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

        // IF THERE ARE NO EMPTY FIELDS THEN-
        else :

            $name = trim($data->name);
            $email = trim($data->email);
            $password = trim($data->password);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                $returnData = msg(0, 422, 'Invalid Email Address!');

            elseif (strlen($password) < 8) :
                $returnData = msg(0, 422, 'Your password must be at least 8 characters long!');

            elseif (strlen($name) < 3) :
                $returnData = msg(0, 422, 'Your name must be at least 3 characters long!');

            else :
                try {

                    $check_email = "SELECT `email` FROM `users` WHERE `email`=:email";
                    $check_email_stmt = $conn->prepare($check_email);
                    $check_email_stmt->bindValue(':email', $email, PDO::PARAM_STR);
                    $check_email_stmt->execute();

                    if ($check_email_stmt->rowCount()) :
                        $returnData = msg(0, 422, 'This E-mail already in use!');

                    else :
                        $insert_query = "INSERT INTO `users`(`name`,`email`,`password`) VALUES(:name,:email,:password)";

                        $insert_stmt = $conn->prepare($insert_query);

                        // DATA BINDING
                        $insert_stmt->bindValue(':name', htmlspecialchars(strip_tags($name)), PDO::PARAM_STR);
                        $insert_stmt->bindValue(':email', $email, PDO::PARAM_STR);
                        $insert_stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

                        $insert_stmt->execute();

                        $returnData = msg(1, 201, 'You have successfully registered.');

                    endif;
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage());
                }
            endif;
        endif;

        echo json_encode($returnData);
    }
    public function login()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: POST");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        function msg($success, $status, $message, $extra = [])
        {
            return array_merge([
                'success' => $success,
                'status' => $status,
                'message' => $message
            ], $extra);
        }

        $db_connection = new Database();
        $conn = $db_connection->connect();

        $data = json_decode(file_get_contents("php://input"));
        $returnData = [];

        // IF REQUEST METHOD IS NOT EQUAL TO POST
        if ($_SERVER["REQUEST_METHOD"] != "POST") :
            $returnData = msg(0, 404, 'Page Not Found!');

        // CHECKING EMPTY FIELDS
        elseif (
            !isset($data->email)
            || !isset($data->password)
            || empty(trim($data->email))
            || empty(trim($data->password))
        ) :

            $fields = ['fields' => ['email', 'password']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

        // IF THERE ARE NO EMPTY FIELDS THEN-
        else :
            $email = trim($data->email);
            $password = trim($data->password);

            // CHECKING THE EMAIL FORMAT (IF INVALID FORMAT)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                $returnData = msg(0, 422, 'Invalid Email Address!');

            // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
            elseif (strlen($password) < 8) :
                $returnData = msg(0, 422, 'Your password must be at least 8 characters long!');

            // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
            else :
                try {

                    $fetch_user_by_email = "SELECT * FROM `users` WHERE `email`=:email";
                    $query_stmt = $conn->prepare($fetch_user_by_email);
                    $query_stmt->bindValue(':email', $email, PDO::PARAM_STR);
                    $query_stmt->execute();

                    // IF THE USER IS FOUNDED BY EMAIL
                    if ($query_stmt->rowCount()) :
                        $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
                        $check_password = password_verify($password, $row['password']);

                        // VERIFYING THE PASSWORD (IS CORRECT OR NOT?)
                        // IF PASSWORD IS CORRECT THEN SEND THE LOGIN TOKEN
                        if ($check_password) :

                            $jwt = new JwtHandler();
                            $token = $jwt->jwtEncodeData(
                                'http://localhost/php_auth_api/',
                                array("user_id" => $row['id'])
                            );

                            $returnData = [
                                'success' => 1,
                                'message' => 'You have successfully logged in.',
                                'token' => $token
                            ];

                        // IF INVALID PASSWORD
                        else :
                            $returnData = msg(0, 422, 'Invalid Password!');
                        endif;

                    // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
                    else :
                        $returnData = msg(0, 422, 'Invalid Email Address!');
                    endif;
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage());
                }

            endif;

        endif;

        echo json_encode($returnData);
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
}
