<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 14/11/2018
 * Time: 20:12
 */

# Can use require statements for all the individual files here
# or require the bootstrap file and include them all there
require_once '../app/bootstrap.php';

//echo 'hello world! ';

# Init Core Library - I think symfony4 has the CoreController as public/index.php
$init = new CoreController();

//print "<pre>";
//print_r($init);
//print "</pre>";