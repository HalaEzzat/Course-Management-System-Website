<?php
require_once '../init.php';
include_once '../answer.php';
session_start();
if(!isset($_SESSION['login'])){
header('Location: index.php'); // Redirecting To Home Page
}
if($_SESSION['privillages']!=3){
   header('Location: index.php'); 
}
$coursename=filter_input(INPUT_GET, 'id');
$answer=new answer();
$ass=filter_input(INPUT_POST, 'ass');
$Cname=filter_input(INPUT_POST, 'coursename');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $answer->deleteAns($Cname, $ass, $_SESSION['id']);
    echo 'NOW...you can <a href="csassignments.php?id='.$Cname.'">go back</a> and add your new answer!!<br/>';
}
?>
<form action="deletefile.php" method="post">     
Assignment Name: <br/><input type="text" name="ass" /><br/>
Course Name: <?php 
    echo '<br/>';
    $answer->coursegroup($_SESSION['id']);
    echo '<br/>';
     ?>
<input type="Submit" name="submit"/></form>
