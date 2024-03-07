<?php
// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Author.php';
include_once '../../functions/isValid.php'; // Include isValid.php

$database = new Database();
$db = $database->connect();

$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

// Define required fields for validation
$fields = array('id', 'author');

// Validate data
if (!isValid($data, $fields)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
    $author->id = $data->id;
    $author->author = $data->author;

    if ($author->update()) {
        echo json_encode(array('message' => 'Author Updated'));
    } else {
        echo json_encode(array('message' => 'Author Not Updated'));
    }
}
?>
