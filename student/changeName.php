<?php
session_start();
include_once '../student.php';
$student=new student();
$name=filter_input(INPUT_POST, 'name');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $student->edit('name', $name, $_SESSION['id'], '');
}
?>
<form action="changeName.php" method="post">     
new name: <input type="text" name="name" />
<input type="Submit" name="submit"/></form>