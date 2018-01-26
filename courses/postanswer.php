<?php
require_once '../init.php';
include_once '../answer.php';
include_once '../upload.php';
@session_start();
$answer=new answer();
$assname=filter_input(INPUT_POST, 'assname');
$id=$_SESSION['id'];
$course=filter_input(INPUT_POST, 'coursename');
$email=filter_input(INPUT_POST, 'email');
$file=filter_input(INPUT_POST, 'fileToUpload');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    if(filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST')
        {
           $file_location = "../courses/uploads/'.$course.'/answers/".$_FILES["fileToUpload"]["name"];
        }
   $check=$answer->check($course, $assname, $email, $file_location);
   if($check==true){
    $upload=new upload('fileToUpload', 'uploads/'.$course.'/answers/');
    $upload->upload();
   }else{
       echo 'you have already posetd an answer for this  assignment<br/>';
       echo 'if you want to delete it click on the follwing link!<br/>';
        echo '<a href="deletefile.php?id='.$coursename.'">Delete My Answer</a><br/>';
       echo '<a href="csassignments.php?id='.$coursename.'">GO BACK</a>';
   }
   
}

?>
<form action="postanswer.php" method="post" enctype="multipart/form-data"> 
    course name: <?php 
    echo '<br/>';
    $answer->coursegroup($id);
    echo '<br/>';
     ?>
    assignment name: <br><input type="text" name="assname" /><br>
    student email: <br><input type="text" name="email" /><br>
    upload file of answer:<br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
