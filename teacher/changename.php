<?php
session_start();
include_once '../teacher.php';
$teacher=new teacher();
$name=filter_input(INPUT_POST, 'name');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $teacher->edit('name', $name, $_SESSION['id'], '');
}
?>
<form action="changename.php" method="post">     
new name: <input type="text" name="name" />
<input type="Submit" name="submit"/></form>