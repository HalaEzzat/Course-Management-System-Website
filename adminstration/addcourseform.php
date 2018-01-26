<?php
require_once '../init.php';
include_once '../courses.php';
$course=new courses();
$name=filter_input(INPUT_POST, 'name');
$syllabus=filter_input(INPUT_POST, 'syllabus');
$activated=filter_input(INPUT_POST, 'activated');
$startDate=filter_input(INPUT_POST, 'start');
$endDate= filter_input(INPUT_POST, 'end');
$email=filter_input(INPUT_POST, 'email');
$page=filter_input(INPUT_POST, 'link');
if(!empty(filter_input(INPUT_POST, 'submit'))){
$course->addcourse($name, $email, $syllabus, $activated, $startDate, $endDate, $page);
@mkdir("C:\wamp\www\projects\courses\uploads\\$name");
@mkdir("C:\wamp\www\projects\courses\uploads\\$name\material");
@mkdir("C:\wamp\www\projects\courses\uploads\\$name\ass");
@mkdir("C:\wamp\www\projects\courses\uploads\\$name\answers");
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
 
<form action="addcourseform.php" method="post"> 
    name: <br><input type="text" name="name" /><br>
    syllabus: <br><input type="text" name="syllabus" /><br>
    activated:<br><input type="radio" name="activated" value="1">true<br>
    <input type="radio" name="activated" value="2">false<br>
    startDate: <br><input type="text" name="start" id="start"><br>
    endDate: <br><input type="text" name="end" id="end"><br>
    teacher email: <br><input type="text" name="email" /><br>
    link of main page: <br><input type="text" name="link" /><br>
    <input type="Submit" name="submit"/></form>