<?php

// 1. GET-запрос с кастомными HTTP-заголовками
function getWithCustomHeaders() {
    $url = 'https://jsonplaceholder.typicode.com/posts/1';
    
    $headers = [
        'Authorization: Bearer my_token_123',
        'X-Custom-Header: MyValue',
        'Accept: application/json',
    ];
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $responseHeaders = curl_getinfo($ch);
    
    curl_close($ch);
    
    echo "GET с кастомными заголовками (статус $httpCode):\n";
    echo "Использованные заголовки:\n";
    print_r($headers);
    echo "Ответ:\n";
    print_r(json_decode($response, true));
    echo "\n\n";
}

// 2. Отправка JSON-данных в теле запроса (POST)
function postJsonData() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    
    $data = [
        'title' => 'JSON Post',
        'body' => 'Этот пост отправлен как JSON',
        'userId' => 2
    ];
    
    $jsonData = json_encode($data);
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    echo "POST с JSON-данными (статус $httpCode):\n";
    echo "Отправленные данные:\n";
    print_r($data);
    echo "Ответ:\n";
    print_r(json_decode($response, true));
    echo "\n\n";
}

// 3. GET-запрос с параметрами URL
function getWithUrlParams() {
    $baseUrl = 'https://jsonplaceholder.typicode.com/comments';
    
    // Параметры запроса
    $params = [
        'postId' => 1,
        'id' => 3
    ];
    
    // Формируем URL с параметрами
    $url = $baseUrl . '?' . http_build_query($params);
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    echo "GET с параметрами URL (статус $httpCode):\n";
    echo "Использованный URL: $url\n";
    echo "Ответ:\n";
    print_r(json_decode($response, true));
    echo "\n\n";
}

// Выполняем все функции
getWithCustomHeaders();
postJsonData();
getWithUrlParams();

?>