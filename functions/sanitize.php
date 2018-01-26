<?php
//we define the only function we're going to use - the escape function. 
//This will allow us to output any data and ensure all output 
//is protected against XSS attacks.
function escape($string){
    return htmlentities($string,ENT_QUOTES,'UTF-8');
}