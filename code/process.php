<?php
session_start();
ob_start();

require_once 'ApiClient.php';

$api = new ApiClient();
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email'] ?? '');

$url = 'https://www.themealdb.com/api/json/v1/1/categories.php';
$apiData = $api->request($url);

$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['api_data'] = $apiData;

$errors = [];
if(empty($username)) $errors[] = "Имя не может быть пустым";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Некорректный email";

if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
}

$line = $username . ";" . $email . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);

ob_end_clean();
header("Location: index.php");
exit();
?>
