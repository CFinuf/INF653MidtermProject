<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

// Handle preflight OPTIONS request
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Route the request based on the HTTP method
switch ($method) {
    case 'GET':
        include_once 'read.php'; // Include the appropriate read.php file
        break;
    case 'POST':
        include_once 'create.php'; // Include the appropriate create.php file
        break;
    case 'PUT':
        include_once 'update.php'; // Include the appropriate update.php file
        break;
    case 'DELETE':
        include_once 'delete.php'; // Include the appropriate delete.php file
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(array('message' => 'Method Not Allowed'));
        break;
}
?>
