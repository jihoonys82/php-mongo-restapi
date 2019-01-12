<?php
/**
 * Created by PhpStorm.
 * User: ji
 * Date: 11/01/19
 * Time: 4:54 PM
 */

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['ORIG_PATH_INFO'];
foreach($_SERVER as $key=>$item){
    echo $key.'=>'.$item;
    echo "<bR>";
}
$request = explode('/', trim($_SERVER['PATH_INFO']));
$input = json_decode(file_get_contents('php://input'),true);

echo $method;
echo "<br>";

echo $request;
echo "<br>";

echo $input;