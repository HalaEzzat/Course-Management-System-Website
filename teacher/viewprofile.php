<?php
session_start();// Starting Session
if(!isset($_SESSION['profile'])){
header('Location: index.php'); // Redirecting To Home Page
}
include_once '../teacher.php';
$teacher=new teacher();
$teacher->viewprofile($_SESSION['profile']);