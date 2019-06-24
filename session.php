<?php

    @session_start();
    include("databaseconnection.php"); 
    //initiating session variables. Should be on all pages
    
    if (isset($_SESSION['PWID'])) {
        $Employee_FullName =  $_SESSION['Name'];
        $Employee_ID = $_SESSION['PWID'];
        $Role = $_SESSION["role"];
    }else{
        session_destroy();
    }

?>