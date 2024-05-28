<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- skapar formulären med post method -->

<form action="#" method="post" enctype="multipart/form-data">
  <label for="fname">First name</label> <br>
  <input type="text" name="fname" placeholder="John"> <br> <br>

  <label for="banknummer"> Bank Konto Nummer </label>  <br> 
  <input type="text" name="banknummer" placeholder="50 characters max"> <br> <br>

  <label for="saldo"> Saldo </label> <br>
  <input type="text" name="saldo" placeholder="xxxx"> <br> <br>

  <label for="picture"> Bild på dig </label> <br>
  <input type="file" name="picture"> <br> <br>

  <input type="submit" name="submit" value="Spara">
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_bank";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $target_dir = "bilder/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;

    $name = $_POST["fname"];
    $banknummer = $_POST["banknummer"];
    $saldo = $_POST["saldo"];

    if (empty($name) || empty($banknummer) || empty($saldo) || (strlen($banknummer) < 4 || strlen($banknummer) > 34)) {
        echo "Fylla in alltig rätt snälla.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO user_info (picture, namn, Bankkonto, saldo)
            VALUES ('$target_file', '$name', '$banknummer', '$saldo')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully <br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Något gick fel med uppladdnings proccessen";
        }
    }

    $conn->close();
}
?>

</body>
</html>
