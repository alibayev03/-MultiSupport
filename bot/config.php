<?php
$TOKEN = '7807594631:AAHkkW1GRcONEsl5_sGfgiQ1Ail-ixg4sd8';
$group_chat_id = '-4853335709'; // замените на свой ID группы

try {
    $pdo = new PDO("mysql:host=localhost;dbname=init;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
date_default_timezone_set('Asia/Tashkent');

?>
