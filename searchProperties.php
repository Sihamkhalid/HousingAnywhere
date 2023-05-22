<?php
$connection = mysqli_connect("localhost", "root", "root", "web_project");
if (mysqli_connect_error() != null) {
    echo "<p>Could not connect to the database.</p>";} 
else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $category = $_POST['c'];
            $sql = "SELECT * FROM `property` WHERE property_category_id = '$category' AND p_id NOT IN (SELECT property_id FROM `rentalapplication` WHERE application_status_id=1 OR home_seeker_id=1)";//needs $id
            $result = mysqli_query($connection, $sql);
            $myObj = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $myObj[] = $row;
            }
            print_r(json_encode($myObj));
            header('Content-Type: text/plain');
        }
        mysqli_close($connection);
}
?>

