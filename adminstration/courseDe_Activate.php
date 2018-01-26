<?php
require_once '../init.php';
include '../courses.php';
$course=new courses();
$name=filter_input(INPUT_POST, 'name');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $course->de_activate($name);
}
?>
<form action="courseDe_Activate.php" method="post">     
name: <input type="text" name="name" />
<input type="Submit" name="submit"/></form>