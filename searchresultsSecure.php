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

<h2 class="guestbookRoom">Search Results</h2>

<?php
echo "<table>";
echo "<tr>
		<th>Id</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Comments</th>
		<th>Date</th>
	</tr>";
	
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$dsn = "mysql:host=localhost;dbname=db1tester;charset=utf8mb4";
$options = [
  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];
try {
$pdo = new PDO($dsn, "root", "", $options);
$search = "%{$_POST['searchnametwo']}%";
$stmt = $pdo->prepare("SELECT id, fname, lname, comments, datenow FROM user WHERE fname LIKE ? OR lname LIKE ?");
$stmt->execute([$search, $search]);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
	error_log($e);
	exit('Generic Error message');
}


$stmt = null;
echo "</table>";

/*
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

$stmt = $conn->prepare('SELECT * FROM user WHERE fname = ?');
$stmt->bind_param('s', $fname);

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
echo "<tr>
			<td> " . $row["id"]. " </td>
			<td> " . $row["fname"]. " " . $row["lname"]. "</td>
			<td> " . $row["comments"]. " </td>
			<td> " . $row["datenow"] . " </td>
		</tr>";	
}




$name=$_POST["searchnametwo"];
echo "<br> Search results for $name <br>";

//Step2
$query = "SELECT id, fname, lname, comments, datenow FROM user WHERE fname LIKE '%$name%' OR lname LIKE '%$name%'";
mysqli_query($conn, $query) or die('Error querying database.');
$result = mysqli_query($conn, $query);

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


mysqli_close($conn);
*/
?>


<br>
<div id="buttonFooter">
<a href="landing.html">Back to Guestbook</a>
</div>
</body>
</html>