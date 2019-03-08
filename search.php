<!DOCTYPE html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="db1tester";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
	die("connection failed:" . $conn->connect_error);
}
echo "Connected Successfully";
?>

<html>
<head>
	<title> Search Guestbook </title>
	<style >	
	</style>
</head>
<body>
<h2> Search the guestbook </h2>

<form action="searchresults.php" method="POST">
	Name:<br>
	<input type="text" name="searchnametwo">
	<br>
	<input type="submit" value="Submit">
</form>

<form action="viewall.php" method="POST">
	<br><input type="submit" value="View All">
</form>

<br>
<a href="addtodb.php">Add to Database Page</a>



</body>
</html>