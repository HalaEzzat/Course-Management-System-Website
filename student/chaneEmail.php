<?php
session_start();
include_once '../student.php';
$student=new student();
$email=filter_input(INPUT_POST, 'email');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $student->edit('email', $email, $_SESSION['id'], '');
}
?>
<form action="chaneEmail.php" method="post">     
new email: <input type="text" name="email" />
<input type="Submit" name="submit"/></form>
