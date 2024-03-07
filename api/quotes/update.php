<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../functions/isValid.php'; // Include isValid.php

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

// Define required fields for validation
$fields = array('id', 'quote', 'author_id', 'category_id');

// Validate data
if (!isValid($data, $fields)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->update()) {
        echo json_encode(array('message' => 'Quote Updated'));
    } else {
        echo json_encode(array('message' => 'Quote Not Updated'));
    }
}
?>
