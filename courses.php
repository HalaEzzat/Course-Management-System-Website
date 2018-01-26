<?php
include_once 'DB.php';
class courses{
    private $name,
            $teacherID,
            $syllabus,
            $activated,
            $startDate,
            $endDate,
            $page,
            $database=null;
    
    public function __construct(){
            $this->database=DB::getInstance();
        }
    
    public function findcourse($name) {
        $this->database->get('cources', array('name','=',$name));
        $rows=$this->database->resultset();
        if(!empty($rows)){
        echo "<pre>";
        print_r($rows);
        echo "</pre>";}
        else{
            echo'ERROR...not found!!';
        }
    }
    
    public function addcourse($name,$email,$syllabus,$activated,$startDate,$endDate,$page){
        $this->name=$name;
        $this->syllabus=$syllabus;
        $this->endDate=$endDate;
        $this->startDate=$startDate;
        $this->activated=$activated;
        $this->database->get('users', array('email','=',$email));
        $rows=$this->database->resultset();
        $teacherID=$rows[0]['id'];
        $sql=$this->database->insert('cources', array(
            'name'=>$name,
            'syllabus'=>$syllabus,
            'activated'=>$activated,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'page'=>$page
        ));
        
        if($sql==TRUE){
            $this->database->get('cources', array('name','=',$name));
            $rows2=$this->database->resultset();
            $this->database->insert('teachergroup', array(
            'code'=>$rows2[0]['id'],
            'teacherId'=>$teacherID));
        }else{
            echo 'already exist!!';
        }
        
    }
    
    public function activate($name,$endDate) {
        $this->activation=TRUE;
        $this->database->get('cources', array('name','=',$name));
        $rows=$this->database->resultset();
        $this->database->update('cources',$rows[0]['id'], array(
            'activated'=>1,
            'endDate'=>$endDate
        ));
    }
    
    public function de_activate($name) {
        $this->activation=FALSE;
        $this->database->get('cources', array('name','=',$name));
        $rows=$this->database->resultset();
         $this->database->update('cources',$rows[0]['id'], array(
            'activated'=>2
        ));
         
    }
    
    public function setactivated($name) {
        $this->database->get('cources', array('name','=',$name));
        $rows=$this->database->resultset();
        $this->endDate=$rows[0]['endDate'];
        if($this->endDate <= date("Y-m-d")){
           $this->database->update('cources', $rows[0]['id'], array('activated'=>2));
       }
    }
            
    public function check($name) {
        $this->database->get('cources', array('name','=',$name));
        $rows=$this->database->resultset();
        if($rows[0]['activated']==2){
            die("this course isn't available now!!");
        }
    }
}
