<?php
$host = 'db'; // Docker ішіндегі MySQL контейнерінің аты
$dbname = 'eduflow_db';
$username = 'root';
$password = 'root'; // Өз пароліңді қоюыңа болады

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Қате: " . $e->getMessage());
}
?>