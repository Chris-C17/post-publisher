<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 15/11/2018
 * Time: 15:38
 */

class PostsController extends BaseController
{
    # Check if session user id is here, if not then redirect
    # Doing this in the constructor will redirect no matter what method in the constructor
    # we use (even index). If you want guests to access index then you don't want to put this
    # in the constructor, only want it in methods that you want to be protected.
    # Here, all the PostsController functionality are only available to isLoggedIn() users
    public function __construct()
    {
        # If not loggedIn - redirect to login page (using session helper)
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');

    }

    public function index()
    {
        # Get posts form the model Post.php
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function myPage()
    {

    }
}