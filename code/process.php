<?php
// попытка пофиксить недостаток прав в записи data.txt
// session_start();
// ob_start();

// // Диагностика прав доступа
// echo "Current directory: " . __DIR__ . "<br>";
// echo "Current user: " . get_current_user() . "<br>";
// echo "UID: " . posix_getuid() . "<br>";
// echo "GID: " . posix_getgid() . "<br>";

// $filename = "data.txt";
// echo "File exists: " . (file_exists($filename) ? "YES" : "NO") . "<br>";
// if (file_exists($filename)) {
//     echo "Is writable: " . (is_writable($filename) ? "YES" : "NO") . "<br>";
//     echo "Permissions: " . substr(sprintf('%o', fileperms($filename)), -4) . "<br>";
// }

// $username = htmlspecialchars($_POST['username']);
// $email = htmlspecialchars($_POST['email'] ?? '');

// $_SESSION['username'] = $username;
// $_SESSION['email'] = $email;

// $line = $username . ";" . $email . "\n";

// // Пробуем записать с диагностикой
// $result = file_put_contents($filename, $line, FILE_APPEND);
// if ($result === false) {
//     echo "ERROR: Failed to write to file<br>";
//     error_log("Failed to write to data.txt");
// } else {
//     echo "SUCCESS: Written $result bytes<br>";
// }

session_start();
ob_start();

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email'] ?? '');

$_SESSION['username'] = $username;
$_SESSION['email'] = $email;

$line = $username . ";" . $email . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);

ob_end_clean();
header("Location: index.php");
exit();
?>
