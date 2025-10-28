<?php
require 'db.php';
require 'order.php';

$order = new Order($pdo);
$all = $order->getAll();
?>

<h2>Сохраненные данные</h2>
<ul>
    <?php foreach($all as $row): ?>
     <li>
        Name: <?= $row['name'] ?>, 
        Amount: <?= $row['amount'] ?>,
        Food: <?= $row['food'] ?>, 
        Sauce: <?= $row['add_sauce']?>, 
        Delivery: <?= $row['type_delivery'] ?>
    </li>
<?php endforeach; ?>
</ul>

<a href="form.html">Заполнить форму</a>