<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 24/11/2018
 * Time: 20:23
 */

class UsersController extends BaseController
{
    # load model
    public function __construct()
    {
        $this->userModel = $this->model('User');

    }

    public function register()
    {
        # Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            # Process form

            # Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            # Init data so users don't need to re-enter data
            $data =[
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            # Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                # check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'This email has already been registered';
                }
            }

            # Validate name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            # Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6 ){
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            # Validate confirm password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = "Passwords don't match";
                }
            }

            # Make sure errors are empty then encrypt password and register user
            if(empty($data['email_err']) && empty($data['name_err'])
                && empty($data['password_err']) && empty($data['confirm_password_err'])){

                # Validated
                # Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                # Register User
                if($this->userModel->register($data))
                {
                    flash('register_success', 'Successfully registered! You can now login');
                    # Redirect to login page (using a redirect helper function)
//                    header('location: ' . URLROOT . "/?url=users/login");
                    redirect('users/login');
                } else {
                    die('something went wrong');
                }

            } else {
                # Load view with errors
                $this->view('users/register', $data);
            }


        } else {
            # Init data so users don't need to re-enter data
            $data =[
              'name' => '',
              'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            # Load View (form) and pass in data
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        # Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            # Process form
            # Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            # Init data so users don't need to re-enter data
            $data =[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            # Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            # Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            # Check for user/email
            if($this->userModel->findUserByEmail($data['email']))
            {
                # User found

            } else {
                # User not found, set error
                $data['email_err'] = 'No user found with this email';
            }

            # Ensure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                # Validated
                # Check and set logged user
                $loggedInUser = $this->userModel->loginUser($data['email'], $data['password']);

                # If User is logged, createUserSession (variables) & redirects to pages/index
                if($loggedInUser)
                {
                    # Creating Session (logged in)
                    $this->createUserSession($loggedInUser);
                } else {
                    # re-render form and return password error
                    $data['password_err'] = 'Incorrect password';

                    $this->view('users/login', $data);
                }

            } else {
                # load view with errors
                $this->view('users/login', $data);
            }


        } else {
            # Init data so users don't need to re-enter data
            $data =[
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            # Load View (form) and pass in data
            $this->view('users/login', $data);
        }
    }

    # Takes in $row from loginUser() function in model User.php then sets $row to $loggedInUser
    # in login() function above, then calls this function passing in $loggedInUser as $user
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('posts/index');
    }

    # logout and remove session variables
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }
}