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
//echo "Connected Successfully";

$name=$_POST["searchnametwo"];
echo "<br> Search results for $name <br>";

//Step2
$query = "SELECT id, fname, lname, comments, datenow FROM user WHERE fname LIKE '%$name%' OR lname LIKE '%$name%'";
mysqli_query($conn, $query) or die('Error querying database.');
$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
	echo "<table border=1  cellspacing=0 cellpading=0>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>
			<td> id: " . $row["id"]. " </td>
			<td> Name: " . $row["fname"]. " " . $row["lname"]. "</td>
			<td> Comments: " . $row["comments"]. " </td>
			<td> " . $row["datenow"] . " </td>
			</tr>";
		}
echo "</table>";	
} else {
	echo "0 results";
}

mysqli_close($conn);
?>

<html>

<body>
<br>
<a href="addtodb.php">Add to Database Page</a>
<br>
<a href="search.php">Back to search Page</a>

</body>

</html>