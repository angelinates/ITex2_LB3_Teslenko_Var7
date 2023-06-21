<?php
require_once "connection.php";

$start_time = $_GET["start_time"];
$end_time = $_GET["end_time"];

if(isset($start_time) && isset($end_time)){
    try {
        $sql = "SELECT start, stop FROM seanse WHERE start >= :start AND stop <= :end";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":start", $start_time);
        $stmt->bindParam(":end", $end_time);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        echo "<response>";
        echo "<dates>";
        foreach($result as $item){
            echo "<date>" . $item["start"] . " " . $item["stop"] . "</date>";
        }
        echo "</dates>";
        echo "</response>";
    } catch(PDOException $e) {
        echo "Ошибка подключения к базе данных: " . $e->getMessage();
    }
}
else {
    echo "No start time or end time";
}
?>