<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    require_once __DIR__ . '/../app/config/Config.php';
    require_once __DIR__ . '/../app/config/Database.php';
    require_once __DIR__ . '/../app/core/Model.php';
    require_once __DIR__ . '/../app/core/Controller.php';
    require_once __DIR__ . '/../app/core/App.php';
    require_once __DIR__ . '/../app/models/Inventaris.php';
    require_once __DIR__ . '/../app/services/InventarisService.php';
    require_once __DIR__ . '/../app/controllers/InventarisController.php';

    new App();

} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Internal Server Error',
        'error'   => $e->getMessage(),
        'file'    => $e->getFile(),
        'line'    => $e->getLine()
    ], JSON_PRETTY_PRINT);
}