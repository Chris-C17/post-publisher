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

    }

    public function register()
    {
        # Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            # Process form
            echo "something";
        } else {
            # Init data so users don't need to re-enter data
            $data =[
              'name' => '',
              'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            # Load View (form) and pass in data
            $this->view('users/register', $data);
        }
    }
}