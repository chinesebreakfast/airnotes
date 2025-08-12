<?php
header("Content-Type: application/json");
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/Post.php';
require_once __DIR__ . '/controllers/PostController.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Получаем endpoint из URL
$request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$endpoint = $request_uri[1] ?? ''; // api/posts → posts
try {
    $testDb = new Database();
    if($testDb->conn === null){
        throw new Exception("Database connection is null");
    }
    $testQuery = $testDb->conn->query("SELECT 1");
    if($testQuery === false) {
        throw new Exception("Database test query failed");
    }
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    exit;
}

// Обработка маршрутов
try {
    if ($endpoint === 'posts') {
        $controller = new PostController();
        
        // Определяем ID если есть (api/posts/123)
        $id = $request_uri[2] ?? null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !$id) {
            $controller->handleRequest();
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !$id){
            $controller->handleRequest();
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $id) {
            $controller->handleSinglePost($id);
        }
        else {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}