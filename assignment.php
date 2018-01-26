<?php
include_once 'DB.php';
class assignment{
    private $coursename,
            $courseId,
            $assName,
            $startDate,
            $endDate,
            $teacherEmail,
            $location,
            $teacherId,
            $database=null;
    
    public function __construct($teacherId=null,$coursename=null,$courseId=null,$assName=null,$startDate=null,$endDate=null,$teacherEmail=null,$location=null) {
        $this->assName=$assName;
        $this->courseId=$courseId;
        $this->coursename=$coursename;
        $this->endDate=$endDate;
        $this->startDate=$startDate;
        $this->location=$location;
        $this->teacherId=$teacherId;
        $this->teacherEmail=$teacherEmail;
        $this->database=DB::getInstance();
        
    }
    
    public function addassignment() {
        $this->database->get('cources',array('name','=',$this->coursename));
        $rows=$this->database->resultset();
        $this->courseId=$rows[0]['id'];
        $this->database->get('users',array('email','=',$this->teacherEmail));
        $rows2=$this->database->resultset();
        $this->teacherId=$rows2[0]['id'];
        $result=$this->database->insert('assignment',array(
           'courseId'=>$this->courseId,
           'name'=>$this->assName,
           'startDate'=>$this->startDate,
           'endDate'=>$this->endDate,
           'teacherId'=>$this->teacherId,
            'location'=>$this->location
        ));
        if($result==true){
        echo 'successfully added!!';
        }else{
            echo 'ERROR...';
        }
    }
    
    public function postass($coursename) {
        $this->database->get('cources',array('name','=',$coursename));
        $rows=  $this->database->resultset();
        $this->database->get('assignment',array('courseId','=',$rows[0]['id']));
        $rows5=  $this->database->resultset();
        $size=  $this->database->rowCount();
        if(!empty($rows5)){
            for($i=0;$i<$size;$i++){
                $this->database->get('cources',array('id','=',$rows5[$i]['courseId']));
                $rows2=$this->database->resultset();
                $this->database->get('users',array('id','=',$rows5[$i]['teacherId']));
                $rows3=$this->database->resultset();
                echo "<table border=0>"
                    . "<tr>"
                        ."<td>". "name:" . "</td>"
                        ."<td>". $rows5[$i]['name'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "course name:" ."</td>"
                        ."<td>". $rows2[0]['name'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "start date" ."</td>"
                        ."<td>". $rows5[$i]['startDate'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "end date:" ."</td>"
                        ."<td>". $rows5[$i]['endDate'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "teacher email:" ."</td>"
                        ."<td>". $rows3[0]['email'] ."</td>"
                        ."</tr>"
                    ."<tr>"
                        ."<td>". "assignment:" ."</td>"
                        ."<td>". '<a href="'.$rows5[$i]['location'].'">assignment</a>' ."</td>"
                        ."</tr><br/><br/><br/>";
    
            }
        }
    }
    
   
    
}