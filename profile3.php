<?php
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
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['login']; ?></i></b>
<b id="logout"><a href="user/logout.php">Log Out</a></b>
</div>
    <h1>you are student</h1>
    <a href="student/viewProfile.php">view profile</a><br/>
</body>
</html>
