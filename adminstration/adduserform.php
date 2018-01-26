<?php
require_once '../init.php';
include_once '../users.php';
$user=new user();
$name=filter_input(INPUT_POST, 'name');
$email=filter_input(INPUT_POST, 'email');
$password=filter_input(INPUT_POST, 'password');
$groupId=filter_input(INPUT_POST, 'groupId');
$genderId=filter_input(INPUT_POST, 'genderId');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $user->adduser($name, $email, $password, $groupId, $genderId);
}
?>
<form action="adduserform.php" method="post">     
    full name: <br><input type="text" name="name" /><br>
    email: <br><input type="text" name="email" /><br>
    password: <br><input type="password" name="password" /><br>
    privillages: <br><input type="radio" name="groupId" value="1">Adminstrator<br>
    <input type="radio" name="groupId" value="2">Teacher<br>
    <input type="radio" name="groupId" value="3">Student<br>
    gender: <br><input type="radio" name="genderId" value="1">Female<br>
    <input type="radio" name="genderId" value="3">Male<br>
<input type="Submit" name="submit"/></form>