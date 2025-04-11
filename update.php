<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usedcar";

$id = $_POST['id'];

$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['tel'];
$addressline1 = $_POST['adressline1'];
$addressline2 = $_POST['adressline2'];
$postcode = $_POST['zipcode'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE manufacturer SET `name` = '$name', `email` = '$email', `tel` = '$telephone', `adressline1` = '$addressline1', `addressline2` = '$addressline2', `zipcode` = '$postcode', `city` = '$city', `state` = '$state', `country` = '$country'
          WHERE id='$id'";


  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>