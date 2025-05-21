<?php

function makeApiRequest($url, $method = 'GET', $data = null, $headers = []) {
    $ch = curl_init();
    
    // Базовые настройки cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    // Настройки метода и данных
    switch (strtoupper($method)) {
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            break;
        case 'PUT':
        case 'DELETE':
        case 'PATCH':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            break;
    }
    
    if ($data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
        $headers[] = 'Content-Type: application/json';
    }
    
    // Установка заголовков
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    
    // Выполнение запроса
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    $errorNo = curl_errno($ch);
    
    curl_close($ch);
    
    // Обработка ошибок cURL
    if ($errorNo !== 0) {
        throw new RuntimeException("cURL error (#$errorNo): $error");
    }
    
    // Обработка HTTP ошибок
    if ($httpCode >= 400) {
        $errorMessage = "HTTP error $httpCode";
        if ($response) {
            $decoded = json_decode($response, true);
            if (isset($decoded['message'])) {
                $errorMessage .= ": " . $decoded['message'];
            }
        }
        throw new RuntimeException($errorMessage, $httpCode);
    }
    
    // Парсинг успешного ответа
    $decodedResponse = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new RuntimeException("JSON parse error: " . json_last_error_msg());
    }
    
    return [
        'status' => $httpCode,
        'data' => $decodedResponse,
        'raw' => $response
    ];
}

// Пример использования с обработкой исключений
try {
    // 1. Успешный запрос с парсингом JSON
    echo "1. Успешный GET-запрос:\n";
    $result = makeApiRequest('https://jsonplaceholder.typicode.com/posts/1');
    print_r($result['data']);
    echo "\n\n";
    
    // 2. Обработка HTTP ошибки (404 Not Found)
    echo "2. Обработка HTTP ошибки (404):\n";
    try {
        $result = makeApiRequest('https://jsonplaceholder.typicode.com/nonexistent');
        print_r($result);
    } catch (RuntimeException $e) {
        echo "Поймана ошибка: " . $e->getMessage() . "\n";
        echo "HTTP код: " . $e->getCode() . "\n\n";
    }
    
    // 3. Обработка ошибки cURL (неверный URL)
    echo "3. Обработка ошибки cURL (неверный URL):\n";
    try {
        $result = makeApiRequest('https://nonexistent-domain.example.com');
        print_r($result);
    } catch (RuntimeException $e) {
        echo "Поймана ошибка: " . $e->getMessage() . "\n\n";
    }
    
    // 4. Успешный POST с JSON данными
    echo "4. Успешный POST с JSON данными:\n";
    $postData = [
        'title' => 'Новый пост',
        'body' => 'Содержание нового поста',
        'userId' => 1
    ];
    $result = makeApiRequest(
        'https://jsonplaceholder.typicode.com/posts',
        'POST',
        $postData
    );
    print_r($result['data']);
    echo "\n\n";
    
} catch (Exception $e) {
    // Глобальная обработка исключений
    echo "Неожиданная ошибка: " . $e->getMessage() . "\n";
}

?>