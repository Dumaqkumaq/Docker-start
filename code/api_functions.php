<?php
require_once 'ApiClient.php';
function fetchExchangeRates() {
    $url = 'https://www.themealdb.com/api/json/v1/1/categories.php';
    $api = new ApiClient();
    $response = $api->request($url);
    
    if ($response === false) {
        throw new Exception('Не удалось подключиться к API курсов валют');
    }
    // Преобразуем в массив, если это строка
    if (is_string($response)) {
        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid JSON from API');
        }
    } else {
        $data = $response;
    }
    
    return $data;
}
?>