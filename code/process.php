<?php
// Включим отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Подключение к базе данных
require 'db.php';

// Подключим класс Order (убедитесь, что файл называется Order.php)
require 'order.php';

try {
    $order = new Order($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получаем данные из формы
        $name = trim($_POST['username'] ?? '');
        $food = trim($_POST['food'] ?? '');
        $amount = intval($_POST['amountfood'] ?? 0);
        $add_sauce = isset($_POST['addsauce']) ? 1 : 0;
        $type_delivery = $_POST['delivertype'] ?? '';

        $errors = [];

        // Валидация
        if (empty($name) || strlen($name) < 2) {
            $errors[] = 'Name must be at least 2 characters';
        }

        if (empty($food)) {
            $errors[] = 'Please choose food';
        }

        if ($amount <= 0) {
            $errors[] = 'Amount must be greater than 0';
        }

        if (empty($type_delivery)) {
            $errors[] = 'Please choose delivery type';
        }

        // Если есть ошибки, возвращаем на форму
        if (!empty($errors)) {
            $errorMessage = implode(', ', $errors);
            header('Location: form.php?status=error&message=' . urlencode($errorMessage));
            exit;
        }

        // Сохраняем заказ
        $result = $order->add($name, $amount, $food, $add_sauce, $type_delivery);

        header('Location: index.php');
        exit;
    }
} catch (Exception $e) {
    // Логируем ошибку и показываем пользователю
    error_log("Error in process.php: " . $e->getMessage());
    header('Location: form.php?status=error&message=Server error: ' . urlencode($e->getMessage()));
    exit;
}
?>