<?php session_start(); ?>
<?php if(isset($_SESSION['username'])): ?>
    <p>������ �� ������:</p>
    <ul>
        <li>���: <?= $_SESSION['username'] ?></li>
        <li>Email: <?= $_SESSION['email'] ?></li>
    </ul>
<?php else: ?>
    <p>������ ���� ���.</p>
<?php endif; ?>
<a href="form.html">��������� �����</a> |
<a href="view.php">���������� ��� ������</a>