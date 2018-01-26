<?php
session_start();// Starting Session
if(!isset($_SESSION['profile'])){
header('Location: index.php'); // Redirecting To Home Page
}
include_once '../student.php';
$student=new student();
$student->viewprofile($_SESSION['profile']);