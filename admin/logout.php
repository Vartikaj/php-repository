<?php
    include "config.php";
    //THESE LINE OF CODE BASICALLY FOR WHEN WE WANT TO DELETE THE SESSION 
    session_start();
    session_unset();
    session_destroy();
    
    header("location:index.php");
?>
