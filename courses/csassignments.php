<?php
require_once '../init.php';
include_once '../teacher.php';
include_once '../student.php';
include_once '../assignment.php';
session_start();
$teacher=new teacher();
$student=new student();
$coursename=filter_input(INPUT_GET, 'id');
$check2=$student->checkcoursepage($_SESSION['id'], $coursename);
$ass=new assignment();
$check=$teacher->checkcoursepage($_SESSION['id'], $coursename);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $coursename.'  assignment page'; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
   
    <?php
    echo '<a href="CourseMain.php?id='.$coursename.'">GO BACK</a><br/>';
    if($check==TRUE){
    include_once 'postassignment.php';
    }else if($check2==true){
        echo 'please upload your answer';
        include_once 'postanswer.php';
        echo '<br/>';
        echo '<a href="grades.php">your grades</a>';

    }
  ?>
     <?php 
     $ass->postass($coursename);
     ?>

    
    </body>
</html>
