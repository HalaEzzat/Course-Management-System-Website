<?php
require_once '../init.php';
include '../courses.php';
$course=new courses();
$name=filter_input(INPUT_POST, 'name');
$end=filter_input(INPUT_POST, 'end');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $course->activate($name,$end);
}
?>
<head>

  <link href="jqueryCalendar.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="jquery-1.6.2.min.js"></script>
  <script src="jquery-ui-1.8.15.custom.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#end").datepicker({dateFormat: "yy-mm-dd"});
  });
  </script>
</head>
<form action="courseActivate.php" method="post">     
name: <br><input type="text" name="name" /><br/>
endDate :<br/>
<input type="text" name="end" id="end"/><br/>
<input type="Submit" name="submit"/></form>