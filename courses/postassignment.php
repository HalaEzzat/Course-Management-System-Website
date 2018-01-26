<?php
require_once '../init.php';
include_once '../assignment.php';
include_once '../upload.php';
$name=filter_input(INPUT_POST, 'name');
$course=filter_input(INPUT_POST, 'coursename');
$startDate=filter_input(INPUT_POST, 'start');
$endDate= filter_input(INPUT_POST, 'end');
$email=filter_input(INPUT_POST, 'email');
$file=filter_input(INPUT_POST, 'fileToUpload');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $upload=new upload('fileToUpload', 'uploads/'.$course.'/ass/');
    $upload->upload();
    if(filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST')
        {
           $file_location = "../courses/uploads/$course/ass/".$_FILES["fileToUpload"]["name"];
        }
    $ass=new assignment($teacherId=null, $course, $courseId=null, $name, $startDate, $endDate, $email,$file_location);
    $ass->addassignment();
}

?>
<head>

  <link href="jqueryCalendar.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="jquery-1.6.2.min.js"></script>
  <script src="jquery-ui-1.8.15.custom.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#start").datepicker({dateFormat: "yy-mm-dd"});
  });
  $(document).ready(function() {
    $("#end").datepicker({dateFormat: "yy-mm-dd"});
  });
  </script>
</head>
 
<form action="postassignment.php" method="post" enctype="multipart/form-data"> 
    assignment name: <br><input type="text" name="name" /><br>
    course name: <br><input type="text" name="coursename" /><br>
    startDate: <br><input type="text" name="start" id="start"><br>
    endDate: <br><input type="text" name="end" id="end"><br>
    teacher email: <br><input type="text" name="email" /><br>
    upload file of assignment:<br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

