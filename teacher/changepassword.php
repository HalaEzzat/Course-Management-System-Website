<?php
session_start();
include_once '../teacher.php';
$teacher=new teacher();
$password=filter_input(INPUT_POST, 'password');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $teacher->edit('password', $password, $_SESSION['id'], '');
}
?>
<form action="changepassword.php" method="post">     
    new password: <input type="password" name="password" />
<input type="Submit" name="submit"/></form>