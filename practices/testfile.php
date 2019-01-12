<?php
/**
 * Created by PhpStorm.
 * User: ji
 * Date: 10/01/19
 * Time: 6:57 PM
 */
require_once __DIR__ . "/vendor/autoload.php";


$collection = (new MongoDB\Client)->test->users;

$insertOneResult = $collection->insertOne([
   'username'=>'test123',
   'email'=>'test@test.com',
   'name'=>'test123 name',
]);

printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

print_r($insertOneResult->getInsertedId());

echo "test";
