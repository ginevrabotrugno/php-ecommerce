<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "php-ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    var_dump($row);
  }
} else {
  echo "0 results";
}
$conn->close();
?>
