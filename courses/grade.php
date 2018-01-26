<?php
require_once '../init.php';
include_once '../answer.php';
$answer=new answer();
$grade=filter_input(INPUT_POST, 'grade');
$ansID=filter_input(INPUT_POST, 'id');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $answer->grade($grade, $ansID);
}