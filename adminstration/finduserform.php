<?php
require_once '../init.php';
include_once '../users.php';
$user=new user();
$email=filter_input(INPUT_POST, 'email');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $user->finduser($email);
}
?>
<form action="finduserform.php" method="post">     
email: <input type="text" name="email" />
<input type="Submit" name="submit"/></form>