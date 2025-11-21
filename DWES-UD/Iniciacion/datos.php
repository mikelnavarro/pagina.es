<!DOCTYPE html>
<html>
  <head></head>
  <body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$num = rand(0,100);

$sql = "INSERT INTO MyGuests (firstname, lastname, email, num)
VALUES ('$firstname', '$lastname', '$email', $num)";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
</body>
</html>
