<?php
require_once "connection.php";

$id_client = $_GET["client"];

if(isset($id_client)){
    try {
        $sql = "SELECT start, stop FROM `seanse` WHERE `fid_client` = :id_client";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id_client', $id_client);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: text/plain');
        foreach($result as $item){
            echo "Початок сеансу: " . $item["start"] . " - кінець сеансу: " . $item["stop"];
        }
    } catch(PDOException $e) {
        echo "Ошибка подключения к базе данных: " . $e->getMessage();
    }
}
else {
    echo "No client id";
}
?>