<?php
require_once '../init.php';
include_once '../teacher.php';
include_once '../upload.php';
session_start();
$coursename=filter_input(INPUT_GET, 'id');
$teacher=new teacher();
$upload=new upload('fileToUpload','uploads/'.$coursename.'/material/');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $upload->upload();
}
$check=$teacher->checkcoursepage($_SESSION['id'], $coursename);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $coursename.' material page'; ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php 
    if($check===TRUE){
    echo '<a href="CourseMain.php?id='.$coursename.'">GO BACK</a><br/><br/><br/>';
    echo ' <form action="csmaterial.php?id='.$coursename.'" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form><br/>';
} ?>
    <?php $upload->listuploaded(); ?>
    </body>
</html>
