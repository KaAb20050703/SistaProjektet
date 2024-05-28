<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_bank";

// skapa connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checka connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT picture, namn, Bankkonto, saldo FROM user_info";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo"<th>Bild</th>";
    echo"<th>Namn</th>";
    echo"<th>Bankkonto</th>";
    echo"<th>Saldo</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td><img src='" . $row["picture"] . "' alt='Bild' style='width:100px;height:100px;'></td>";
        echo "<td>" . $row["namn"] . "</td>";
        echo "<td>" . $row["Bankkonto"] . "</td>";
        echo "<td>" . $row["saldo"] . "</td>";
        echo "</tr>";
    }
}

?>

</body>
</html>
