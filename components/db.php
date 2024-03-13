<?php
$host = 'localhost';
$db = 'your_name_db';
$user = 'your_username_for_db';
$pass = 'your_password_for_db';
$port = 3307;

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
} catch (PDOException $e) {
  echo 'Ошибка соединения с БД'.$e->getMessage();
}
?>
