<?php
$connection = mysqli_connect("localhost","root","root","web_project");
$error = mysqli_connect_error();
if($error != null){
echo "<h1> Could not access database <h1>";} 
        if(isset($_GET['delete'])){
            delete($_GET['delete']);
        }
        
        function delete($deleted){
           $delete_sql = "DELETE FROM rentalapplication WHERE property_id=".$deleted;
           global $connection;
           mysqli_query( $connection, $delete_sql);
           $delete_sql = "DELETE FROM propertyimage WHERE property_id=".$deleted;
           mysqli_query( $connection, $delete_sql);
           $delete_sql = "DELETE FROM property WHERE p_id=".$deleted;
           mysqli_query( $connection, $delete_sql);
           header("Location: HomeOwner.php");
           die();
        }
