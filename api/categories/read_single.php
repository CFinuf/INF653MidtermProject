<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Get ID from URL
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read single category
$category->read_single();

// Create array
$category_arr = array(
    'id' => $category->id,
    'category' => $category->category
);

// Make JSON
print_r(json_encode($category_arr));
?>
