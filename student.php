<?php
include_once 'users.php';
class student extends user{//teacher inhirit user cause teacher is a user
    protected $mainDep,
              $subDep,
              $level,
              $courseId,
              $database=null;
       
        public function __construct(){
            parent::__construct();
            $this->database=  DB::getInstance();
        }
        
        public function viewprofile($email) {
            $this->database->get('users',array('email','=',$email));
            $rows=$this->database->resultset();
            if(!empty($rows)){
                $this->setID($rows[0]['id']);
                $this->setEmail($email);
                $this->setGender($rows[0]['genderId']);
                $this->setName($rows[0]['name']);
                $this->setgroup($rows[0]['groupId']);
                $this->setpasswowrd($rows[0]['password']);
            }
            $this->database->get('student',array('id','=',$this->getID()));
            $rows2=$this->database->resultset();
            if(!empty($rows2)){
                $this->level=$rows2[0]['level'];
                $this->mainDep=$rows2[0]['mainDep'];
                $this->subDep=$rows2[0]['subDep'];
            }
            $this->database->get('sex',array('id','=',$this->getGender()));
            $rows3=$this->database->resultset();
            $gender=$rows3[0]['gender'];
            $this->database->get('groups',array('id','=',$this->getGroup()));
            $rows4=$this->database->resultset();
            $group=$rows4[0]['name'];
            $this->database->get('coursegroup',array('ST_ID','=',  $this->getID()));
            $rows5=$this->database->resultset();
            $size=  $this->database->rowCount();
            $this->database->get('department',array('id','=',$this->mainDep));
            $rows6=$this->database->resultset();
            $main=$rows6[0]['department'];
            $this->database->get('department',array('id','=',$this->subDep));
            $rows7=$this->database->resultset();
            $sub=$rows7[0]['department'];
            echo "<table border=0>"
            . "<tr>"
                . "<td>". "name:" . "</td>"
                ."<td>". $this->getName() ."</td>"
                ."<td>"."<a href='changeName.php'>"."change"."</a>"."</td>"
                ."</tr>"
            ."<tr>"
                ."<td>". "email:" ."</td>"
                ."<td>". $this->getEmail() ."</td>"
                ."<td>"."<a href='chaneEmail.php'>"."change"."</a>"."</td>"
                ."</tr>"
            ."<tr>"
                ."<td>". "password:"."</td>"
                ."<td>". $this->getPassword() ."</td>"
                ."<td>"."<a href='changePassword.php'>"."change"."</a>"."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "privellages:" ."</td>"
                ."<td>". $group ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "gender:" ."</td>"
                ."<td>". $gender ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "main specialization: " ."</td>"
                ."<td>".$main."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "sub specialization: " ."</td>"
                ."<td>". $sub ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "level:"."</td>"
                ."<td>".$this->level."</td>"
                ."</tr>"
        ."</table>";
            
        echo 'your courses:<br/>';
        for($i=0;$i<$size;$i++){
            $this->database->get('cources',array('id','=',$rows5[$i]['courseId']));
            $rows8=$this->database->resultset();
            $name=$rows8[0]['name'];
            if(!empty($rows8)){
            echo "<br/>";
            echo "<a href='/projects/courses/CourseMain.php?id=".$name."'>$name</a>";
            
            }
        }
        }
        
    public function edit($field,$value,$id,$table) {
       switch($field){
           case 'name':
               $table='users';
               $this->database->update($table, $id, array($field=>$value));
               break;
           case 'password':
               $table='users';
               $this->database->update($table, $id, array($field=>$value));
               break;
           case 'email':
               $table='users';
               $this->database->get($table,array( 'email','=',$value));
               $rows=$this->database->resultset();
               if(!empty($rows)){
                   echo 'ERROR...this email is used!!';
               }else{
                  $this->database->update($table, $id, array($field=>$value)); 
               }
               break;
           default :
               break;
       }
        }
        
        
    public function getdegree($cousrename,$stid) {
        $this->database->get('cources',array('name','=',$cousrename));
        $rows=$this->database->resultset();
        $this->database->get('answer',array('studentId','=',$stid));
        $rows2=  $this->database->resultset();
        $size=$this->database->rowCount();
        echo '<table border="1" style="width:20%"><tr>';
        for($i=0;$i < $size;$i++){
            if($rows[0]['id']==$rows2[$i]['courseId']){
                $this->database->get('assignment',array('id','=',$rows2[$i]['assignmentId']));
                $rows3=  $this->database->resultset();
                echo ' <td>'.$rows3[0]['name'].'</td>
                      <td>'.$rows2[$i]['grade'].'</td></tr>';
                }
            }
            echo '</table>';
        }
        
    
    public function checkcoursepage($id,$coursename) {
        $x=false;
        $this->database->get('coursegroup', array('ST_ID','=',$id));
        $rows=$this->database->resultset();
        $size=$this->database->rowCount();
        for($i=0;$i<$size;$i++){
           $this->database->get('cources', array('id','=',$rows[$i]['courseId']));
           $rows2=$this->database->resultset(); 
           if( $rows2[$i]['name']==$coursename){
               $x=TRUE;
           }  
        }
        if($x==TRUE){
        return TRUE;
        }else {
        return FALSE;
        }
    }    
        
}