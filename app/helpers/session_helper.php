<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 30/11/2018
 * Time: 13:45
 */

# Starts session for storing user's login details
session_start();

# Flash message helper (using bootstrap alert class)
# Example - flash('register_success', 'you are now registered', 'alert alert-danger');
# alert alert-danger will make the flash message red, (blank) default is set to green
# Display in view - echo flash('register_success');
function flash($flash = '', $message = '', $class = 'alert alert-success')
{
    if(!empty($flash) && !empty($message) && empty($_SESSION[$flash]))
    {

        # unset session[$flash_class] if it is already set
        if(!empty($_SESSION[$flash . '_class']))
        {
            unset($_SESSION[$flash . '_class']);
        }

        # Set session name and class to $message and $class variables passed in
        $_SESSION[$flash] = $message;
        $_SESSION[$flash . '_class'] = $class;

    } elseif (empty($message) && !empty($_SESSION[$flash])) {
        $class = !empty($_SESSION[$flash . '_class']) ? $_SESSION[$flash . '_class'] : '';
        echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$flash] . '</div>';
        unset($_SESSION[$flash]);
        unset($_SESSION[$flash . '_class']);
    }
}

# Check to see if user is logged in
function isLoggedIn()
{
    if(isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}