<?php
session_start();
include_once '../student.php';
$student=new student();
$password=filter_input(INPUT_POST, 'password');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $student->edit('password', $password, $_SESSION['id'], '');
}
?>
<form action="changePassword.php" method="post">     
    new password: <input type="password" name="password" />
<input type="Submit" name="submit"/></form>
