<?php
require_once "connection.php";

try {
    $stmt = $connection->prepare("SELECT balance, name FROM client WHERE balance < 0");
    $stmt->execute();    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($result);
} catch(PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
?>