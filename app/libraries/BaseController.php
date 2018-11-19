<?php
/**
 * Base Controller  (Was called Controller.php before)
 * loads the models and views
 * Every controller we use will extend this core controller
 */

class BaseController
{
    # Load model
    public function model($model)
    {
        # Require model file
        require_once '../app/models/' . $model . '.php';

        # Instantiate model (again I think this is tight coupling and dependency injection
        # should be used?)
        return new $model();
    }

    # Load View - pass in view (php file that User sees and $data array)
    # Need to be abe to pass data into the view from database or hard-coded data
    public function view($view, $data = [])
    {
        # Check for view file
        if(file_exists('../app/views/' . $view . '.php'))
        {
            require_once '../app/views/' . $view . '.php';
        } else {
            # View doesn't exist
            die("View doesn't exist");
        }
    }
}