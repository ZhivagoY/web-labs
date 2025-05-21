<?php

// 1. GET-запрос для получения списка постов
function getPosts() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    echo "GET запрос (статус $httpCode):\n";
    print_r(json_decode($response, true)[0] ?? []); // Выводим первый пост для примера
    echo "\n\n";
}

// 2. POST-запрос для создания нового поста
function createPost() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $data = [
        'title' => 'Новый пост',
        'body' => 'Содержание нового поста',
        'userId' => 1
    ];
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    echo "POST запрос (статус $httpCode):\n";
    print_r(json_decode($response, true));
    echo "\n\n";
    
    return json_decode($response, true)['id'] ?? null;
}

// 3. PUT-запрос для обновления поста
function updatePost($postId) {
    if (!$postId) {
        echo "Не удалось получить ID поста для обновления\n";
        return;
    }
    
    $url = "https://jsonplaceholder.typicode.com/posts/$postId";
    $data = [
        'id' => $postId,
        'title' => 'Обновленный пост',
        'body' => 'Обновленное содержание поста',
        'userId' => 1
    ];
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    echo "PUT запрос (статус $httpCode):\n";
    print_r(json_decode($response, true));
    echo "\n\n";
}

// 4. DELETE-запрос для удаления поста
function deletePost($postId) {
    if (!$postId) {
        echo "Не удалось получить ID поста для удаления\n";
        return;
    }
    
    $url = "https://jsonplaceholder.typicode.com/posts/$postId";
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    echo "DELETE запрос (статус $httpCode):\n";
    echo "Пост $postId удален\n";
    echo "DELETE: " . $response . "\n";
}
?>