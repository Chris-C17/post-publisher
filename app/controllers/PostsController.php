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

    public function add()
    {
        # Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            # Process form
            # Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'boyd_err' => '',
            ];

            # Validate Title
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }

            # Validate Body
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter text in the body';
            }

            #Ensure errors are empty
            if(empty($data['title_err']) && empty($data['body_err'])) {
                # Validated, send data to database?
                if($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }

            } else {
                # load view with errors
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => '',
            ];

            $this->view('posts/add', $data);
        }
    }

    public function myPage()
    {

    }
}