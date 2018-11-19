<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 14/11/2018
 * Time: 20:26
 */

# Load config
require_once 'config/config.php';

//# Load Libraries (not case sensitive)
//require_once 'libraries/CoreController.php';
//require_once 'libraries/BaseController.php';
//require_once 'libraries/DatabaseController.php';

# Autoload Core Libraries (same as above)
spl_autoload_register(function ($className)
{
    require_once 'libraries/' . $className . '.php';
});