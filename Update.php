<?php
$connection = mysqli_connect("localhost","root","root","web_project");
$error = mysqli_connect_error();
if($error != null){
echo "<h1> Could not access database <h1>";}    

        if(isset($_GET['declineOne'])){
            declineOne($_GET['declineOne']);
        }

        if (isset($_GET['accept']) && isset($_GET['rent'])){
            accept($_GET['accept']);
            decline($_GET['rent']);
        }

        function accept($res){
           $accepted_sql = "UPDATE rentalapplication SET application_status_id=1 WHERE ra_id=".$res;
           global $connection;
           mysqli_query( $connection, $accepted_sql);

        }
        function decline($rented){

            $declined_sql = "Update rentalapplication SET application_status_id=2 WHERE property_id=".$rented." AND application_status_id != '1'";
            global $connection;
            mysqli_query( $connection, $declined_sql);
            header("Location: HomeOwner.php");
            die();

        }

        function declineOne($hsId){
            $decline = "UPDATE rentalapplication SET application_status_id=2 WHERE ra_id=".$hsId;
            global $connection;
            mysqli_query( $connection, $decline);
            header("Location: HomeOwner.php");
            die();

        }
