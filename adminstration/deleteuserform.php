<?php
require_once '../init.php';
include '../users.php';
$user=new user();
$email=filter_input(INPUT_POST, 'email');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $user->deleteuser($email);
}
?>
<form action="deleteuserform.php" method="post">     
email: <input type="text" name="email" />
<input type="Submit" name="submit"/></form>