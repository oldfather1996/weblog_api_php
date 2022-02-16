<?php

namespace app\controllers;

class BaseController
{

    const VIEW_FOLDER =  __DIR__ . '/../views';

    protected function view($viewPath, $data = [])
    {
        foreach ($data as $key => $value) {
            //$$ = Khai báo biến + key
            $$key = $value;
        }
        return require_once(self::VIEW_FOLDER . '/' . str_replace(".", '/', $viewPath) . '.php');
    }

    protected function response($data, $status = '')
    {
        //header_remove() : Clear all header previously
        header_remove();
        header("Content-type: application/json; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        if ($status) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
        echo json_encode($data);
    }
}
