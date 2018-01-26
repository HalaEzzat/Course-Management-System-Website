<?php
require_once '../init.php';
include_once '../courses.php';
$course=new courses();
$name=filter_input(INPUT_POST, 'name');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $course->findcourse($name);
}
?>
<form action="findcourseform.php" method="post">     
course name: <input type="text" name="name" />
<input type="Submit" name="submit"/></form>
