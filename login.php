<?php 
    if(!isset($_SESSION)) session_start();
    $_SESSION['id'] = 1;
    $_SESSION['role'] = 'owner';
    header('location:Editpropertypage.php?id=1');
?>
