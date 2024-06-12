<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//
date_default_timezone_set('Asia/KolKata');
session_start();

// $servername = "192.168.43.96";
$servername = "localhost";
$username = "root";
$password = "";
$database = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>