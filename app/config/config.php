<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 19/11/2018
 * Time: 16:56
 */

# DB params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Type password here');
define('DB_NAME', 'post-publisher.db');

# App Route - define app directory as a constant
define('APPROOT', dirname(dirname(__FILE__)));
# URL Root (from the public folder of project)
define('URLROOT', 'http://localhost/post-publisher/public');
# Site Name
define('SITENAME', 'Post Publisher');
# App Version
define('APPVERSION', '1.0.0');