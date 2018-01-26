<?php
include_once '../student.php';
$student=new student();
session_start();// Starting Session
if(!isset($_SESSION['login'])){
header('Location: index.php'); // Redirecting To Home Page
}
if($_SESSION['privillages']!=3){
   header('Location: index.php'); 
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Grades</title>
<link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['login']; ?></i></b>
<b id="logout"><a href="user/logout.php">Log Out</a></b>
</div>
    <?php
   $student->getdegree('cs', $_SESSION['id']);
    ?>
    
</body>
</html>