<?php
session_start();
require_once 'ApiClient.php';
try{
    $url = 'https://www.themealdb.com/api/json/v1/1/categories.php';
    $api = new ApiClient();
    $response = $api->request($url);

    if($response == false){
        throw new Exception('Cannot connect to API');
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

    $_SESSION['api_data'] = $data;
;

    echo json_encode(['success' => true, 'data' => $data, 'message' => 'Data is successfull updated']);

} catch (Exception $e){
    echo json_encode(['success' => false, 'message'=> $e->getMessage()]);
}
?>