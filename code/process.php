<?php
require 'db.php';
require 'order.php';

$order = new Order($pdo);

$name = htmlspecialchars($_POST['name'] ?? 'Гость');
$food = htmlspecialchars($_POST['food'] ?? 'Латте');
$amount = intval($_POST['amount']);
$add_sauce = isset($_POST['add_sauce']) ? 1 : 0;
$type_delivery = htmlspecialchars($_POST['type_delivery']);

$order->add($name, $amount, $food, $add_sauce, $type_delivery);

header("Location: index.php");
exit();
?>