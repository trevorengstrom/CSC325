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

//Query Database
$query = "SELECT * FROM user";
mysqli_query($conn, $query) or die('Error querying database.');
$result = mysqli_query($conn, $query);

//Show Results
if ($result->num_rows > 0) {
	echo "<table border=1  cellspacing=0 cellpading=0>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Comments</th>
		<th>Date/Time</th>
	</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>
			<td> " . $row["id"]. " </td>
			<td> " . $row["fname"]. " " . $row["lname"]. "</td>
			<td> " . $row["comments"]. " </td>
			<td> " . $row["datenow"] . " </td>
			</tr>";
		}
echo "</table>";	
} else {
	echo "0 results";
}

//Close connection
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