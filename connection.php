<?php
define("DBHOST",'localhost');
define("DBNAME",'web_project');
define("DBUSER",'root');
define("DBPASS",'root');

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$error = mysqli_connect_error();
        
if($error != null) {
    echo "Error Connection";
    die (mysqli_connect_errno());
}
?>