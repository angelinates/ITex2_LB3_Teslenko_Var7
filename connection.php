<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lb_pdo_netstat";

    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>