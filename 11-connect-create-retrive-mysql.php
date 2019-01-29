<?php  
/*p82-p109*/
   //-------------connected to database------------
   $dbhost = 'localhost:3306';
   $dbuser = 'root';
   $dbpass = '';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }  
   echo 'Connected successfully<br />';
   
   //-------------create a database named test_db----------
   $sql = 'CREATE Database test_db';
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not create database: ' . mysql_error());
   }  
   echo "Database test_db created successfully<br />";
   //--------------select the database to use-------------
   mysql_select_db( 'test_db' );
   
   //--------------create a table in the selected database----------
   $sql = "CREATE TABLE employee(".
      "emp_id INT NOT NULL AUTO_INCREMENT, emp_name VARCHAR(20), emp_address VARCHAR(20),".
	  "emp_salary INT, join_date VARCHAR(20), primary key ( emp_id ))";
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not create table: ' . mysql_error());
   }
   
   echo "Table employee created successfully<br />";
   
   //--------------insert data into the selected table----------------
    $sql = 'INSERT INTO employee '.
      '(emp_name,emp_address, emp_salary, join_date) '.
      'VALUES ( "guest", "XYZ", 2000, NOW() )';
      
   mysql_select_db('test_db');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not enter data: ' . mysql_error());
   }
   
   echo "Entered data successfully<br />";
   
   //----------retrieve data from the selected database---------------
   $sql = 'SELECT emp_id, emp_name, emp_salary FROM employee';
   mysql_select_db('test_db');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
   
   while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
      echo "EMP ID :{$row['emp_id']}  <br> ".
         "EMP NAME : {$row['emp_name']} <br> ".
         "EMP SALARY : {$row['emp_salary']} <br> ".
         "--------------------------------<br>";
   }
   
   echo "Fetched data successfully<br />";
   
   //---------------update data in the selected database-----------
   $sql = "UPDATE employee ". "SET emp_salary = 200394 ". 
               "WHERE emp_id = 0" ;
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "Updated data successfully<br />";
		
/*		
   //---------------delete data in the selected database------
	$sql = "DELETE FROM employee WHERE emp_id = 0" ;
            $retval = mysql_query( $sql, $conn );           
            if(! $retval ) {
               die('Could not delete data: ' . mysql_error());
            }            
            echo "Deleted data successfully<br />";   
			
   //---------------------delete a database-------------
    $sql = 'DROP DATABASE test_db';
   $retval = mysql_query( $sql, $conn );
   echo "Deleted database successfully<br />"; 
   //---------------------------------------------------	
*/   
   mysql_close($conn);
?>