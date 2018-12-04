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
        # Load Post and User model in constructor so it can be used everywhere
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');

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

    public function edit($id)
    {
        # Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            # Process form
            # Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            # Need to pass in $id in data so it can be passed into updatePost()
            $data = [
                'id' => $id,
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

            # Ensure errors are empty before updating post
            if(empty($data['title_err']) && empty($data['body_err'])) {
                # Validated, send data to database?
                if($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }

            } else {
                # load view with errors
                $this->view('posts/edit', $data);
            }

        } else {
            # Get existing post from model
            $post = $this->postModel->getPostById($id);

            # Only allow owner of post to access view/edit. Redirect user if not owner.
            if($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
            ];

            # Load view for editing post
            $this->view('posts/edit', $data);
        }
    }

    # show needs to pass in an id (of the post) - an id of 3 has /?url=posts/show/3
    public function show($id) {

        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            # Get existing post from model
            $post = $this->postModel->getPostById($id);

            # Only allow owner of post to access view/delete. Redirect user if not owner.
            if($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            if($this->postModel->deletePost($id)) {
                flash('post_message', 'Post deleted');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }
}