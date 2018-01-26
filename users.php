<?php
include_once 'DB.php';
require_once 'init.php';
class user{
    protected $Id, 
            $name,
            $email,
            $password,
            $groupId,
            $genderId,
            $database=null;
    
        public function __construct(){
        $this->database=  DB::getInstance();        
        }
        public function setName($name) {
        $this->name=$name;
         }
    
        public function setGender($gender) {
        $this->genderId=$gender;
        }
    
        public function setgroup($group) {
        $this->groupId=$group;
        }
        
        public function setID($id) {
            $this->Id=$id;
        }
        
        public function setpasswowrd($password) {
            $this->password=$password;  
        }
        
        public function getName() {
            return $this->name;
        }
        
        public function getID() {
            return $this->Id;
        }
        
        public function getEmail() {
            return $this->email;
        }
        
        public function getPassword() {
            return $this->password;
        }
        
        public function getGroup() {
            return $this->groupId;
        }
        
        public function getGender() {
            return $this->genderId;
        }
    
        public function setEmail($email) {
        $this->email=$email;
        }
    
        public function finduser($email){
        $this->database->get('users', array('email','=',$email));
        $rows=$this->database->resultset();
        if(!empty($rows)){
        echo "<pre>";
        print_r($rows);
        }
        else{
            echo'ERROR...not found!!';
        }
        }
        
        public function logout() {
        session_start();
        if(session_destroy()) // Destroying All Sessions
        {
        header("Location: ../index.php"); // Redirecting To Home Page
        }
        }
        
        public function login($email,$password) {
                $this->database->get('users', array('email','=',$email));
                $rows=$this->database->resultset();
                if(!empty($rows)){
               if($rows[0]['email']==$email && $rows[0]['password']==$password){
                    $_SESSION['login'] = $rows[0]['name'];
                    $_SESSION['profile']=$rows[0]['email'];
                    $_SESSION['id']=$rows[0]['id'];
                    $_SESSION['privillages']=$rows[0]['groupId'];
                    if($rows[0]['groupId']==1){
                        header("location: profile1.php");
                    }
                    if($rows[0]['groupId']==2){
                        header("location: profile2.php");
                    }
                    if($rows[0]['groupId']==3){
                        header("location: profile3.php");
                    }
                }}
                else{
                    echo 'no such user...please check your data and try again';
                }
            }
        

        public function adduser($name,$email,$password,$groupId,$genderId){
        $this->name=$name;
        $this->email=$email;
        $this->genderId=$genderId;
        $this->groupId=$groupId;
        $this->password=$password;
        $sql=$this->database->insert('users', array(
            'name'=>$name,
            'email'=>$email,
            'genderId'=>$genderId,
            'groupId'=>$groupId,
            'password'=>$password
        ));
        if($sql==TRUE){
            echo 'succesfully added!!';
        }else{
            echo 'already exist!!';
        }
    }
    
    public function deleteuser($email) {
        $this->database->get('users', array('email','=',$email));
        $rows=$this->database->resultset();
        if(!empty($rows)){
        if($rows[0]['groupId']==2){
        $this->database->get('teacher', array('id','=',$rows[0]['id']));
        $rows2=$this->database->resultset();  
        if(!empty($rows2)){
            $this->database->delete('teacher', array('id','=',$rows[0]['id']));
        }
        }
        
        $sql=$this->database->delete('users', array('email','=',$email));
        if($sql==true){
            echo 'deleted successfully';
        }}
        else{
            echo 'user not found!!';
        }
    }
    
}
