<?php session_start(); ?>
<?php if(isset($_SESSION['username'])): ?>
    <p>Данные из сессии:</p>
    <ul>
        <li>Имя: <?= $_SESSION['username'] ?></li>
        <li>Email: <?= $_SESSION['email'] ?></li>
    </ul>
<?php //looked over internet for div info ?>
<?php if (isset($_COOKIE['last_submission'])): ?>
        <div style="background: #f0f0f0; padding: 10px; margin-bottom: 20px;">
            <p>Последняя отправка формы: <?php echo htmlspecialchars($_COOKIE['last_submission']); ?></p>
        </div>
    <?php endif; ?>
<?php
require_once 'UserInfo.php';
$info = UserInfo::getInfo();

echo "<h3>Информация о пользователе:</h3>";
foreach ($info as $key => $val) {
    echo htmlspecialchars($key) . ': ' . htmlspecialchars($val) . '<br>';
}

if (isset($_SESSION['api_data'])) {
    echo "<h3>Данные из API:</h3>";
    echo "<pre>" . print_r($_SESSION['api_data'], true) . "</pre>";
}
?>
<?php if(isset($_SESSION['errors'])): ?>
    <ul style="color:red;">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>
<?php else: ?>
    <p>Данных пока нет.</p>
<?php endif; ?>
<a href="form.html">Заполнить форму</a> |
<a href="view.php">Посмотреть все данные</a>