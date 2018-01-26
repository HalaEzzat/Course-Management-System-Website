<?php
session_start();// Starting Session
if(!isset($_SESSION['login'])){
header('Location: index.php'); // Redirecting To Home Page
}
if($_SESSION['privillages']!=1){
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
    1-<a href="adminstration/adduserform.php">add user</a><br/>
    2-<a href="adminstration/deleteuserform.php">delete user</a><br>
    3-<a href="adminstration/addcourseform.php">add course</a><br>
    4-<a href="adminstration/finduserform.php">find user</a><br>
    5-<a href="adminstration/courseActivate.php">Activate Course</a><br>
    6-<a href="adminstration/courseDe_Activate.php">De_Activate course</a>
    </body>
</html>
