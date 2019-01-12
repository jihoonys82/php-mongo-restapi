<?php
/**
 * Created by PhpStorm.
 * User: ji
 * Date: 10/01/19
 * Time: 11:38 PM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../vendor/autoload.php";

$collection = (new MongoDB\Client)->test->users;

$users = $collection->find([
    "username"=>"admin",
]);

http_response_code(200);

echo json_encode(iterator_to_array($users));

