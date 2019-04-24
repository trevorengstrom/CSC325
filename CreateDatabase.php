<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="db1tester";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE db3tester";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

//--------------select the database to use-------------
mysqli_select_db( $conn, "db1tester" );
   
   
// Create table to hold guestbook information
$sqlCreate = "CREATE TABLE user (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
fname VARCHAR(30),
lname VARCHAR(30),
comments TEXT,
datenow TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sqlCreate) === TRUE) {
    echo "Table user created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


// Insert initial rows into database
$sqlInsert = "INSERT INTO user (fname, lname, comments) VALUES
            ('John', 'Rambo', 'This website sucks'),
            ('Clark', 'Kent', 'This site is worse than your last site'),
            ('John', 'Carter', 'booooooo'),
            ('Harry', 'Potter', 'Do better! This sucks.')";
if(mysqli_query($conn, $sqlInsert)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sqlInsert. " . mysqli_error($conn);
}


$conn->close();
?>