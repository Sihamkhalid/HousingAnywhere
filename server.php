<?php

if (!isset($_SESSION)) session_start();

$sname= "localhost";
$unmae= "root";
$password = "root";
$db_name = "web_project";
$con = mysqli_connect($sname, $unmae, $password, $db_name);


function getProperty(int $id) : array | null {
    global $con;
    $query = mysqli_query($con, 
        "SELECT property.* , propertycategory.category FROM property 
        JOIN propertycategory on propertycategory.pc_id = property.property_category_id
        WHERE property.p_id = $id"
    );
    return mysqli_fetch_assoc($query);
}

function getPropertyImages(int $id) : array | null {
    global $con;
    $query = mysqli_query($con, "SELECT * FROM propertyimage WHERE property_id = $id");
    return mysqli_fetch_all($query, MYSQLI_ASSOC);
}


if(isset($_GET['apply'])) {
    $prop_id = $_GET['apply'];
    $seeker_id = $_SESSION['id'];

    $sql = "INSERT INTO rentalapplication 
    (property_id, home_seeker_id, application_status_id)
    VALUES ($prop_id, $seeker_id, 3)";

    $query = mysqli_query($con, $sql);
    header('location:homeseeker.php');
}

if(isset($_POST['editprop'])) {
    $sql = "UPDATE property SET 
        name = \"{$_POST['Name']}\", 
        property_category_id = {$_POST['category']},
        rooms = {$_POST['rooms']},
        rent_cost = {$_POST['rent']},
        location = \"{$_POST['plocation']}\",
        max_tenants = \"{$_POST['Pmnot']}\",
        description = \"{$_POST['desc']}\"
        WHERE p_id = {$_POST['id']}
    ";
    echo $sql;
    mysqli_query($con, $sql);
    header("location:PropertyDetailsPage.php?id={$_POST['id']}");
}


if(isset($_POST['addImages'])) {
    $prop_id = $_POST['addImages'];
    $imgs = $_FILES['images'];
    foreach(array_keys($imgs['name']) as $i){
        $name = time().rand().'-'.$imgs['name'][$i];
        $path = "images/".$name;
        move_uploaded_file($imgs['tmp_name'][$i], $path);
        $sql = "INSERT INTO propertyimage (property_id, path) VALUES ($prop_id, \"$path\")";
        mysqli_query($con, $sql);
        header("location:Editpropertypage.php?id=$prop_id");
    }
}


if(isset($_GET['delimg'])) {
    $img = $_GET['delimg'];
    $query = mysqli_query($con, "SELECT * FROM propertyimage WHERE pi_id = $img ");
    $file = "./".mysqli_fetch_assoc($query)['path'];
    // echo $file;
    if(file_exists($file)) unlink($file);
    $sql = "DELETE FROM propertyimage WHERE pi_id = $img ";
    mysqli_query($con, $sql);
    header("location:Editpropertypage.php?id={$_GET['prop']}");
}

?>
