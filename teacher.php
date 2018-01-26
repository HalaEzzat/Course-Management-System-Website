<?php
include_once 'users.php';
class teacher extends user{//teacher inhirit user cause teacher is a user
    protected $department,
            $degree,
            $startDate,
            $name,
            $email,
            $password,
            $gender,
            $group,
            $id,
            $user,
            $database=null;
    
           
        public function __construct(){
            $this->user=new user();
            $this->database=  DB::getInstance();
        }
    
    public function viewprofile($email) {
        $this->database->get('users',  array('email','=',$email));
        $rows=$this->database->resultset();
        if(!empty($rows)){
            $this->id= $rows[0]['id'];
            $this->name=$rows[0]['name'];
            $this->user->setName($this->name); 
            $this->email=$rows[0]['email'];
            $this->user->setEmail($this->email);
            $this->password=$rows[0]['password'];
            $this->user->setpasswowrd($this->password);
            $this->group=$rows[0]['groupId'];
            $this->user->setgroup($this->group);
            $this->gender=$rows[0]['genderId'];
            $this->user->setGender($this->gender);
            $this->database->get('teacher', array('id','=',$this->id));
            $rows2=$this->database->resultset();
            $this->department=$rows2[0]['departmentId'];
            $this->degree=$rows2[0]['degree'];
            $this->startDate=$rows2[0]['startDate'];
            $this->database->get('groups', array('id','=',$this->group));
            $rows3=$this->database->resultset();
            $group=$rows3[0]['name'];
            $this->database->get('sex', array('id','=',  $this->gender));
            $rows4=$this->database->resultset();
            $gender=$rows4[0]['gender'];
            $this->database->get('department', array('id','=',$this->department));
            $rows5=$this->database->resultset();
            $department=$rows5[0]['department'];
            $this->database->get('degree', array('id','=',$this->degree));
            $rows6=$this->database->resultset();
            $degree=$rows6[0]['degree'];
        echo "<table border=0>"
        . "<tr>"
                . "<td>". "name:" . "</td>"
                ."<td>". $this->name ."</td>"
                ."<td>"."<a href='changename.php'>"."change"."</a>"."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "email:" ."</td>"
                ."<td>". $this->email ."</td>"
                ."<td>"."<a href='changeemail.php'>"."change"."</a>"."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "password:"."</td>"
                ."<td>". $this->password ."</td>"
                ."<td>"."<a href='changepassword.php'>"."change"."</a>"."</td>"
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
                ."<td>". "department: " ."</td>"
                ."<td>".$department."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "degree: " ."</td>"
                ."<td>". $degree ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "start date: "."</td>"
                ."<td>".$this->startDate."</td>"
                ."</tr>"
        ."</table>";}
        else {
        echo 'user not found!!';
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
    
    public function checkcoursepage($id,$coursename) {
        $x=false;
        $this->database->get('teachergroup', array('teacherId','=',$id));
        $rows=$this->database->resultset();
        $size=$this->database->rowCount();
        for($i=0;$i<$size;$i++){
           $this->database->get('cources', array('id','=',$rows[$i]['code']));
           $rows2=$this->database->resultset(); 
           if( $rows2[0]['name']==$coursename){
               $x=TRUE;
           }  
        }
        if($x==TRUE){
        return TRUE;
        }else {
        return FALSE;
        }
    }
    
    public function courses($id) {
        $this->database->get('teachergroup', array('teacherid','=',$id));
        $rows=$this->database->resultset();
        if(!empty($rows)){
            $size=$this->database->rowCount();
            for($i=0;$i<$size;$i++){
            $this->database->get('cources', array('id','=',$rows[$i]['code']));
            $rows2=$this->database->resultset();   
            $name=$rows2[0]['name'];
            echo "<br/>";
            echo "<a href='/projects/courses/CourseMain.php?id=".$name."'>$name</a>";
            }
        }else{
            echo 'you still not inrolled in any courses!!';
        }
    }
    
    public function addassinment($coursename,$assname,$startDate,$endDate,$teacherEmail,$location){
        $this->database->get('cources',array('name','=',$coursename));
        $rows=$this->database->resultset();
        $courseId=$rows[0]['id'];
        $this->database->get('users',array('email','=',$teacherEmail));
        $rows2=$this->database->resultset();
        $teacherId=$rows2[0]['id'];
        $this->database->insert('assignment',array(
            'courseId'=>$courseId,
            'name'=>$assname,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'teacherId'=>$teacherId
        ));
        $this->postassignment($coursename,$assname,$startDate,$endDate,$teacherEmail,$location);
    }
    
    public function postassignment($coursename,$assname,$startDate,$endDate,$teacherEmail,$location) {
        echo "<table border=0>"
        . "<tr>"
                . "<td>". "name:" . "</td>"
                ."<td>". $assname ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "course name:" ."</td>"
                ."<td>". $coursename ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "start date" ."</td>"
                ."<td>". $startDate ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "end date:" ."</td>"
                ."<td>". $endDate ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "teacher email:" ."</td>"
                ."<td>". $teacherEmail ."</td>"
                ."</tr>"
        ."<tr>"
                ."<td>". "assignment:" ."</td>"
                ."<td>". '<a href="'.$location.'">assignment</a>' ."</td>"
                ."</tr>";
    }
    
    public function giveGrade($id) {
        $this->database->get('cources',array('id','=',$id));
        $rows=$this->database->resultset();
//        for()
      echo'  
        <form method="post" action="give grade.php">
        <select  name="course">
        
            <?php
            
        ';
    }
    
}