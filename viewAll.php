<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Google Fonts import -->
<link href="https://fonts.googleapis.com/css?family=Caveat|Economica|Patrick+Hand|Permanent+Marker|Special+Elite|quicksand|roboto+mono|cabin" rel="stylesheet">
<!-- Import Google Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Bootstrap -->
<meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link href="guestbookCSS.css" type="text/css" rel="stylesheet"/> 

</head>
<body>

<h2 class="guestbookRoom">Guestbook</h2>

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


<br>
<div id="buttonFooter">
<a href="landing.html">Back to Guestbook</a>
</div>
</body>
</html>