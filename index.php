<?php
    require_once "connection.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ItehLb3</title>
</head>
<body>
    <div>
        <p>Task1 - Отримати сеанси роботи в мережі для обраного клієнта</p>
        <select name="client" id="client">
            <?php
                $sql = "SELECT id_client, name FROM client";
                $stmt = $connection->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $item){
                    echo "<option value=" . $item["id_client"] . ">" . $item["name"] . "</option>";
                }
            ?>
        </select>
        <script>
            const ajax = new XMLHttpRequest();
            function getDataText() {
                ajax.onreadystatechange = function() {
                    if (ajax.readyState === 4 && ajax.status === 200) {
                        document.getElementById("task1res").innerHTML = ajax.responseText;
                    }
                };
                const client = document.getElementById("client").value;
                ajax.open('GET', 'getSeanse.php?client=' + client);
                ajax.send();
            }
        </script>
        <input type="submit" value="get" onclick="getDataText()">
        <div id="task1res"></div>
    </div> 
    <hr>
    <div>
        <p>Task2 - Отримати сеанси роботи в мережі за вказаний проміжок часу</p>
        <input type="time" value="07:30" name="start_time" id="start_time">
        <input type="time" value="23:01" name="end_time" id="end_time">
        <script>    
            function getDataXML() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 200) {
                    const xml = ajax.responseXML;
                    let output = "";
                    let date = xml.getElementsByTagName("date");
                    for (i = 0; i < date.length; i++) {
                        output += date[i].childNodes[0].nodeValue + "<br>";
                    }
                    document.getElementById("task2res").innerHTML = output;
                }
            };
            const start_time = document.getElementById("start_time").value;
            const end_time = document.getElementById("end_time").value;
            ajax.open('GET', 'getSeanseByTime.php?start_time=' + start_time + '&end_time=' + end_time);
            ajax.send();
            }
        </script>
        <input type="submit" value="get" onclick="getDataXML()">
        <div id="task2res"></div>
    </div>
    <hr>
    <div>
        <p>Task3 - Отримати список клієнтів з від'ємним балансом рахунку</p>
        <script>
            function getDataJSON() {
                fetch('getBalance.php')
                    .then(response => response.json())
                    .then(responseJSON => {
                        let output = "";
                        for (let i = 0; i < responseJSON.length; i++) {
                            output += "<p> Ім'я " + responseJSON[i].name + " баланс " + responseJSON[i].balance +  "</p>";
                        }
                        document.getElementById("task3res").innerHTML = output;
                    })
                    .catch(error => console.error(error));
                }
        </script>
        <input type="submit" value="get" onclick="getDataJSON()">
        <div id="task3res"></div>
    </div>
</body>
</html>