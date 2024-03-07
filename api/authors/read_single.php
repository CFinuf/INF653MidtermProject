<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->read_single();

$author_arr = array(
    'id' => $author->id,
    'author' => $author->author
);

print_r(json_encode($author_arr));
?>
