<?php
require_once 'init.php';
include_once 'users.php';
session_start();
$user=new user();
$error="";
if(!empty(filter_input(INPUT_POST, 'submit'))){
    if(empty(filter_input(INPUT_POST, 'email'))||empty(filter_input(INPUT_POST, 'password'))){
    $error="both fields are required!!";
}else{
    $email=filter_input(INPUT_POST, 'email');
    $password=filter_input(INPUT_POST, 'password');
    $user->login($email, $password);
   
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>LOGIN</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>LOGIN</h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>email :</label>
<input id="email" name="email" placeholder="email" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>