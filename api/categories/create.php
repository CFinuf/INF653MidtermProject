<?php
// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';
include_once '../../functions/isValid.php'; // Include isValid.php

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

// Define required fields for validation
$fields = array('category');

// Validate data
if (!isValid($data, $fields)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
    $category->category = $data->category;

    if ($category->create()) {
        echo json_encode(array('message' => 'Category Created'));
    } else {
        echo json_encode(array('message' => 'Category Not Created'));
    }
}
?>
