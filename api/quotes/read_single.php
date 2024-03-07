<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

// Get ID from URL
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read single quote
$quote->read_single();

// Create array
$quote_arr = array(
    'id' => $quote->id,
    'quote' => $quote->quote,
    'author_id' => $quote->author_id,
    'category_id' => $quote->category_id,
    'author_name' => $quote->author_name,
    'category_name' => $quote->category_name
);

// Make JSON
print_r(json_encode($quote_arr));
?>
