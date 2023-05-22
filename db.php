<?php
define('Server_Name' , "localhost" );
define('UserName', "root" );
define('Password' , "root" );
define('DataBase_Name' , "web_project" );

$conn = new mysqli(Server_Name , UserName , Password , DataBase_Name );

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>