<?php
require 'db.php';
require 'order.php';

$order = new Order();
$all = $order->getAll();
?>

<h2>Сохраненные данные</h2>
<ul>
    <?php foreach($all as $row): ?>
     Имя: <li><?= $row['name'] ?>, 
     Кол-во: <?= $row['amount'] ?>,
     Еда: <?= $row['food'] ?>, 
     Добавлять соус: <?= $row['add_sauce'] 'Да' : 'Нет' ?>, 
     Доставка: <?= $row['type_delivery'] ?></li>
<?php endforeach; ?>
</ul>

<a href="form.html">Заполнить форму</a>