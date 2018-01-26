<?php
require_once '../init.php';
include_once '../courses.php';
session_start();
$course=new courses();
$coursename=filter_input(INPUT_GET, 'id');
$course->setactivated($coursename);


?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $coursename; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1><?php echo $coursename; ?> main page</h1>
    <?php 
switch ($_SESSION['privillages']){
    case 1:
        echo '<a href="../profile1.php">MY PAGE</a><br/>';
        break;
    case 2:
        echo '<a href="../profile2.php">MY PAGE</a></br>';
        break; 
    case 3:
        echo '<a href="../profile3.php">MY PAGE</a></br>';
        break;
}
    $course->check($coursename);
    echo ' <a href="csmaterial.php?id='.$coursename.'">material</a><br/>
    <a href="csassignments.php?id='.$coursename.'">assignments</a>';?>
   
    </body>
</html>
