<?php

namespace app\controllers;


require_once(dirname(__FILE__) . '../../config/Database.php');
require_once(dirname(__FILE__) . '../../models/Post.php');
require_once(dirname(__FILE__) . '/BaseController.php');

class HomeController extends BaseController
{
    function __construct()
    {
    }
    public function index()
    {
        return $this->view('client.index');
    }
    public function detail()
    {
        return $this->view('client.detail');
    }
    public function Dashbroad()
    {
        return $this->view('dashbroad.index');
    }
    public function create()
    {
        return $this->view('post.create');
    }
    public function CatDashborad()
    {
        return $this->view('dashbroad.CategoryDashborad');
    }
    public function PostDashborad()
    {
        return $this->view('dashbroad.PostDashborad');
    }
    public function update()
    {
        require_once(dirname(__FILE__) . '../..//views/post/update.php');
    }
}
