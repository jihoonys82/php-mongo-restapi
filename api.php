<?php
/**
 * Created by PhpStorm.
 * User: ji
 * Date: 11/01/19
 * Time: 2:53 PM
 */

require_once __DIR__."/vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO']));
$input = json_decode(file_get_contents('php://input'),true);

$coll = $request[1];
$key = 0;
if(sizeof($request)>2) {
    $key = $request[2];
}

$collection = (new MongoDB\Client)->test->$coll;

switch($method){
    case 'GET':
        $result = $collection->find($input);
        break;
    case 'POST':
        if($key != 0){
            $input['_id'] = $key;
        }
        $result = $collection->insertOne($input);
        //print_r($result);
        break;
    case 'PUT':
        if($key == 0) {
            $result = false;
        } else {
            $result = $collection->updateOne(
                ['_id'=> $key],
                ['$set'=> $input]
            );
        }
        break;
    case 'DELETE':
        if($key == 0) {
            $result = false;
        } else {
            $result = $collection->deleteOne(
                ['_id'=> $key]
            );
        }
        break;
    default :
        $result = false;
        break;
}


if(!$result) {
    http_response_code(404);
} else {
    http_response_code(200);
    if($method==="GET"){
        echo json_encode(iterator_to_array($result));
    } else if($method==="POST"){
        $returnStatement = array();
        $returnStatement['insertedCount'] = $result->getInsertedCount();
        $returnStatement['insertedId'] = $result->getInsertedId();
        echo json_encode($returnStatement);
    } else if($method==="PUT") {
        $returnStatement = array();
        $returnStatement['matchedCount'] = $result->getMatchedCount();
        $returnStatement['modifiedCount'] = $result->getModifiedCount();
        echo json_encode($returnStatement);
    } else if($method==="DELETE") {
        $returnStatement = array();
        $returnStatement['deletedCount'] = $result->getDeletedCount();
        echo json_encode($returnStatement);
    }
}

