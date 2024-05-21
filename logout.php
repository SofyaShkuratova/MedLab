<?php
    session_start();
    unset($_SESSION['user']);
    header('location:home.php') ;  
    unset($_SESSION['doctor']);
    header('location:home.php') ;  

?>