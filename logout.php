<?php
// core configuration
include_once "./connection/connection.php";
session_start();

// destroy session, it will remove ALL session settings
session_destroy();
session_unset();

//redirect to login page
header("Location: ./login.php");
exit();
?>