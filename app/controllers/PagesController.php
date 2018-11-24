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
    }

    # Need an index method if setting the params outside of if statement that checks
    # for a method in URL (array element[1])
    public function index()
    {
        # Using a pages directory in view so need to load pages/index
        $data = [
            'title' => 'Post Publisher!',
            'description' => 'Simple network for sharing posts built on a MVC PHP 
            framework',
        ];

        $this->view('pages/index', $data);
    }

    # Remember .htaccess isn't working so need awkward url with /mvc/public/?url=
    # http://localhost/mvc/public/?url=pages/about/33
//    public function about($id)
    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'Simple app for publishing posts. Enjoy!',
        ];
        $this->view('pages/about', $data);
//        echo "this is about in Pages and the id is ".$id;
    }
}