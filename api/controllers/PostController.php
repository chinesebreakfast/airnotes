<?php
require_once __DIR__ . '/../models/Post.php';

class PostController {
    private $model;

    public function __construct() {
        $this->model = new Post(); // Инициализируем модель один раз
    }

    public function handleRequest() {
        header("Content-Type: application/json");
    
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $posts = $this->model->read();
            
                if ($posts === false) {
                    throw new Exception('Ошибка при получении постов');
                }
            
                echo json_encode([
                   'status' => 'success',
                    'data' => $posts // Гарантированный массив
                ]);
                exit;
            }
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                
                error_log(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


                if(empty($data['label'])) {
                    throw new Exception('Заголовок не может быть пустым');
                }

                $postId = $this->model->create($data['label'], $data['text']);

                echo json_encode([
                    'status' => 'success',
                    'id' => $postId
                ]);
                exit;
            }
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

    public function handleSinglePost($id) {
        header("Content-Type: application/json");
        $method = $_SERVER['REQUEST_METHOD'];
        
        try {
            switch ($method) {
                case 'DELETE':
                    if ($this->model->delete($id)) {
                        echo json_encode(['status' => 'success']);
                    } else {
                        throw new Exception('Post not found');
                    }
                    break;
                    
                case 'PUT':
                    $data = json_decode(file_get_contents('php://input'), true);
                    
                    if(empty($data['label'])) {
                        throw new Exception('Заголовок не может быть пустым');
                    }
                    
                    if ($this->model->update($id, $data['label'], $data['text'])) {
                        echo json_encode(['status' => 'success']);
                    } else {
                        throw new Exception('Ошибка обновления');
                    }
                    break;
                    
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Method not allowed']);
            }
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}