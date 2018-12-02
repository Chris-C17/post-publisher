<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 15/11/2018
 * Time: 15:38
 */

class PostsController extends BaseController
{
    public function index()
    {
        $data = [];

        $this->view('posts/index', $data);
    }

    public function __construct()
    {
//        echo "Posts loaded";
    }

    public function myPage()
    {

    }
}