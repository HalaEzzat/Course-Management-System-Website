<?php
session_start();
include_once '../teacher.php';
include_once '../answer.php';
$teacher=new teacher();
$answer=new answer();
$course=filter_input(INPUT_POST, 'course');
$ass=filter_input(INPUT_POST, 'ass');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $check=$teacher->checkcoursepage($_SESSION['id'], $course);
    if($check==TRUE){
        $answer->postanswer($course, $ass);
    }else{
        echo "ERROR...you don't have permissions to this course";
    }
}

?>
<form action="givegrade.php" method="post">     
course name: <input type="text" name="course" />
assignment name: <input type="text" name="ass" />
<input type="Submit" name="submit"/><br/><br/></form>