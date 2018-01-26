<?php
require_once '../init.php';
include_once '../answer.php';
$answer=new answer();
$grade=filter_input(INPUT_POST, 'grade');
$ansID=filter_input(INPUT_POST, 'id');
$assName=filter_input(INPUT_POST, 'ASSname');
$cname=filter_input(INPUT_POST, 'Cname');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    if(empty($grade)|empty($grade)){
        echo 'ERROR...both fields are required!!';
    }else{
    $answer->grade($grade, $ansID);
    
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>submissions</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1><?php echo $cname; ?></h1>
    <?php $answer->postanswer($cname, $assName); ?>
    </body>
</html>