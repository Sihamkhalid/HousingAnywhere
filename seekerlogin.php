<?php 

    if(!isset($_SESSION)) session_start();
    $_SESSION['id'] = 1;
    $_SESSION['role'] = 'homeseeker';
    header('location:Homeseekerpage.php');

?>