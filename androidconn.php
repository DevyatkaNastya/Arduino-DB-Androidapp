<?php
$servername = "mysql.zzz.com.ua";
$username = "arduinosensordb";
$password = "19966226zN";
$dbname = "arduinosensordb";

// создать подключение
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT temp, hum, time FROM stat";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // вывод данных со всех строк
    while($row = $result->fetch_assoc()) {
        echo "" . date("Y-m-d H:i:s", $row["time"])."<pre>  &nbsp;&nbsp;  |  &nbsp;&nbsp;  </pre>";  //функция data для преобразования интового значения из таблицы в дату
        echo "" . $row["temp"]. "°C <pre>    &nbsp;&nbsp;    |       &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  </pre>" . $row["hum"]. "% <br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
