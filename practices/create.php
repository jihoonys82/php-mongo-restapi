<?php
/**
 * Created by PhpStorm.
 * User: ji
 * Date: 10/01/19
 * Time: 11:30 PM
 */

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__."/vendor/autoload.php";

$collection = (new MongoDB\Client)->test->users;

