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

<h2>Your addition to the Guestbook</h2>

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
$firstName = "{$_POST['firstName']}";
$lastName = "{$_POST['lastName']}";
$comment = "{$_POST['comment']}";
$stmt = $pdo->prepare("INSERT INTO user (fname, lname, comments) VALUES (?, ?, ?)");
$stmt->execute([$firstName, $lastName, $comment]);
echo $stmt->rowCount();  

//Get ID of the last insertion to the DB
$last_id = $pdo->lastInsertID();

//Searches database to return results of the user's last insertion
$search = $pdo->prepare("SELECT id, fname, lname, comments, datenow FROM user WHERE id LIKE ?");
//Execute the search with an array of last_id.
$search->execute([$last_id]);
    $result = $search->setFetchMode(PDO::FETCH_ASSOC);
//prints search results
foreach(new TableRows(new RecursiveArrayIterator($search->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
//writes each error to the php.ini file and gives the user only a generic error message. 
	error_log($e);
	exit('Generic Error message');
}
//closes the connection.
$stmt = null;


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
//echo "Connected Successfully";

//prepared statement
$sql = $conn->prepare("INSERT INTO `user` (`fname`, `lname`, `comments`)  VALUES(?, ?, ?)");
$x=$sql->real_escape_string($_POST['firstname']);
$y=$sql->real_escape_string($_POST['lastname']);
$z=$sql->real_escape_string($_POST['comment']);
$sql->bind_param('sss', $x, $y, $z);
	$sql->exeucte();



//$sql = "INSERT INTO `user` (`fname`, `lname`, `comments`)  VALUES('$x', '$y', '$z')";  

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
} else {
	echo "Error: " . $sql . "<br>" , $conn->error;
}

$query = "SELECT * FROM user where id LIKE $last_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
	echo "<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Comments</th>
		<th>Date/Time</th>
	</tr>";
    // output data of each row
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

$conn->close();

*/

echo "</table>";

?>

<br>
<div id="buttonFooter">
<a href="landing.html">Back to Guestbook</a>
</div>
</body>
</html>