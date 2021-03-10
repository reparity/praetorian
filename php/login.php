<?php
	$servername="localhost";
	$username="root";
	$password="";
	$dbName="praetorian";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$myusername=$_POST['username'];
$mypassword=$_POST['password'];
$sql = "SELECT username, pass FROM admin WHERE username='$myusername' and
password='$mypassword'";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{

header("location:/home");
}
else
{
echo "<meta http-equiv=\"refresh\" content=\"0; url='/adminlogin'\" />";
}
$conn->close();
?>