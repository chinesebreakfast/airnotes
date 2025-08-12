<?php
require_once __DIR__ . '/config/Database.php';

try {
    $db = (new Database())->getConnection();
    echo json_encode([
        'status' => 'success',
        'message' => 'Подключение успешно!',
        'host' => 'MySQL-8.0'
    ]);
} catch(Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}