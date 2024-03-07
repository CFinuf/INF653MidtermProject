<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    // Check if query parameter 'id' exists
    if (isset($_GET['id'])) {
        include_once 'read_single.php'; // Include appropriate read_single.php file
    } elseif ($method === 'GET') {
        include_once 'read.php'; // Include appropriate read.php file
    } elseif ($method === 'POST') {
        include_once 'create.php'; // Include appropriate create.php file
    } elseif ($method === 'PUT') {
        include_once 'update.php'; // Include appropriate update.php file
    } elseif ($method === 'DELETE') {
        include_once 'delete.php'; // Include appropriate delete.php file
    }
?>
