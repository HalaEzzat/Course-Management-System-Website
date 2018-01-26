<?php
include_once 'DB.php';
class answer{
    private $courseId,
            $assignmentId,
            $studentId,
            $grade,
            $location,
            $database=null;
    
    public function __construct() {
        $this->database=DB::getInstance();
    }
    
    public function addanswer(){
        echo '  '.$this->courseId;
        echo '  '.$this->assignmentId;
        echo '  '.$this->studentId;
        echo '  '.$this->location;
        $result=$this->database->insert('answer',array(
           'courseId'=>$this->courseId,
           'assignmentId'=>$this->assignmentId,
           'studentId'=>$this->studentId,
           'location'=>$this->location
        ));
        if($result==true){
        echo 'successfully added!!';
        }else{
            echo 'ERROR...';
         }
    }
    
    public function check($coursename,$assname,$stEmail,$location) {
        $this->database->get('cources',array('name','=',$coursename));
        $rows1=$this->database->resultset();
        $this->courseId=$rows1[0]['id'];
        $this->database->get('assignment',array('courseId','=',$this->courseId));
        $rows2=$this->database->resultset();
        if(!empty($rows2)){
            for($i=0;$i<$this->database->rowCount();$i++){
                if($rows2[$i]['name']==$assname){
                    $this->assignmentId=$rows2[$i]['id'];
                }
            }
        }
        $this->database->get('users',array('email','=',$stEmail));
        $rows3=$this->database->resultset();
        $this->studentId=$rows3[0]['id'];
        $this->location=$location;
        $this->database->get('answer',array('assignmentId','=',$this->assignmentId));
         $result=  $this->database->resultset();
         $size=  $this->database->rowCount();  
         for($i=0;$i<$size;$i++){
             if($result[$i]['studentId']==$this->studentId){     
                 return FALSE;
             }
             
         }
         $this->addanswer();
         return TRUE;
    }
    
    
    public function deleteAns($courseName,$assName,$stID) {
        $this->database->get('cources',array('name','=',$courseName));
        $rows1=  $this->database->resultset();
        $this->courseId=$rows1[0]['id'];
        $this->database->get('assignment',array('courseId','=',  $this->courseId));
        $rows2=  $this->database->resultset();
        $size=  $this->database->rowCount();
        for($i=0;$i<$size;$i++){
            if($rows2[$i]['name']==$assName){
                $this->assignmentId=$rows2[$i]['id'];
            }
        }
        $this->database->get('answer',array('assignmentId','=', $this->assignmentId));
        $rows3=  $this->database->resultset();
        $size2=  $this->database->rowCount();
        $link="";
        for($i=0;$i<$size2;$i++){
            if($rows3[$i]['studentId']==$stID){
                $link=$rows3[$i]['location'];
                $this->database->delete('answer',array('id','=',$rows3[$i]['id']));
                array_map('unlink', glob($link)); 
            }
        }
        
    }

    public function coursegroup($stID) {
        $this->database->get('coursegroup',array('ST_ID','=',$stID));
        $rows= $this->database->resultset();
        $size=  $this->database->rowCount();
        echo '<select name="coursename">';
        for($i=0;$i<$size;$i++){
            $this->database->get('cources',array('id','=',$rows[$i]['courseId']));
            $rows2=  $this->database->resultset();
            echo '<option value="'.$rows2[0]['name'].'">'.$rows2[0]['name'].'</option>';
        }
        echo '</select>';
    }

    public function postanswer($coursename,$assname) {
        $this->database->get('cources',array('name','=',$coursename));
        $rows=$this->database->resultset();
        $this->courseId=$rows[0]['id'];
        $this->database->get('assignment',array('courseId','=',$this->courseId));
        $rows1=$this->database->resultset();
        if(!empty($rows1)){
            for($i=0;$i<$this->database->rowCount();$i++){
                if($rows1[$i]['name']==$assname){
                    $this->assignmentId=$rows1[$i]['id'];
                }
            }
        }
        $this->database->get('answer',array('courseId','=',$this->courseId));
        $rows2=$this->database->resultset();
        $size=0;
        if(!empty($rows2)){
            $size=  $this->database->rowCount();
            for($i=0;$i<$size;$i++){
                if($rows2[$i]['assignmentId']==$this->assignmentId){
                $this->database->get('users',array('id','=',$rows2[$i]['studentId']));
                $rows3=$this->database->resultset();
                 echo "<table border=0>"
                    . "<tr>"
                        ."<td>". "name:" . "</td>"
                        ."<td>". $rows3[0]['name'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "answer:" ."</td>"
                        ."<td>". '<a href="'.$rows2[$i]['location'].'">assignment</a>' ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "answer ID:" ."</td>"
                        ."<td>". $rows2[$i]['id'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "grade:" ."</td>"
                        ."<td>". '<form action="../teacher/submissions.php" method="post"> 
                                  <input type="text" name="grade"/>
                                  answer ID:
                                  <input type="text" name="id"/>
                                  <input type="hidden" value="'.$coursename.'" name="Cname" />
                                  <input type="hidden" value="'.$assname.'" name="ASSname" />
                                  <input type="Submit" value="grade!" name="submit"/>
                                  </form>' 
                        ."</td>"
                        ."</tr>"
                    ."<tr>"."<br/>"."<br/>";   
                }
            }
        }
        
    }
    
    public function grade($grade,$ansID) {
    $check=$this->database->update('answer',$ansID,array(
    'grade'=>$grade
    ));
    if($check==TRUE){
        echo 'successfully graded!!';
    }
    }
}