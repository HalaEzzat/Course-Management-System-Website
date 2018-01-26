<?php
session_start();
include_once '../teacher.php';
$teacher=new teacher();
$email=filter_input(INPUT_POST, 'email');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $teacher->edit('email', $email, $_SESSION['id'], '');
}
?>
<form action="changeemail.php" method="post">     
new email: <input type="text" name="email" />
<input type="Submit" name="submit"/></form>