<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 15/11/2018
 * Time: 15:27
 */

# Set PagesController to be the default Controller in CoreController
class PagesController extends BaseController
{
    public function __construct()
    {
//        echo "Pages loaded";
    }

    # Need an index method if setting the params outside of if statement that checks
    # for a method in URL (array element[1])
    public function index()
    {
        $this->view('Hello');
    }

    public function about($id)
    {
        echo "this is about in Pages and the id is ".$id;
    }
}