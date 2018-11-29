<?php
/**
 * Created by PhpStorm.
 * User: c_chambers
 * Date: 29/11/2018
 * Time: 19:12
 */

# Simple page redirect that takes in page/location
function redirect($page){
    header('location: ' . URLROOT . "/?url=" . $page);
}