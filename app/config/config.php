<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 19/11/2018
 * Time: 16:56
 */

# DB params
define('DB_HOST', 'localhost');
define('DB_USER', 'Type USER here');
define('DB_PASS', 'Type password here');
define('DB_NAME', 'Type database name here');

# App Route - define app directory as a constant
define('APPROOT', dirname(dirname(__FILE__)));
# URL Root (from the public folder of project)
define('URLROOT', 'http://localhost/mvc/public');
# Site Name
define('SITENAME', 'Post Publisher');