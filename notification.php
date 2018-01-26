<?php
include_once 'DB.php';
class notification{
    private $note,
            $title,
            $courseNM,
            $courseId=null,
            $senderId=null,
            $senderEM,
            $perID,
            $database=null;
    
    public function __construct($note,$title,$courseNM,$senderEM,$perID) {
        $this->courseNM=$courseNM;
        $this->note=$note;
        $this->senderEM=$senderEM;
        $this->title=$title;
        $this->perID=$perID;
        $this->database=DB::getInstance();
    }
    
    public function send() {
        $this->database->get('cources',array('name','=',$this->courseNM));
        $rows=  $this->database->resultset();
        $this->courseId=$rows[0]['id'];
        $this->database->get('users',array('email','=',$this->senderEM));
        $rows2=  $this->database->resultset();
        $sql=$this->database->insert('notification',array(
            'courseID'=>$rows[0]['id'],
            'senderID'=>$rows2[0]['id'],
            'note'=>  $this->note,
            'title'=>  $this->title,
            'date'=>date("Y-m-d"),
            'periorityID'=>$this->perID
                ));
        if($sql==TRUE){
            echo 'successfuly posted';
        }else{
            echo 'ERROR!!';
        }
        
    }
            
    public function recieve($state,$noteID,$id=null,$type) {
        switch ($state){
            case 1:
                $this->database->insert('reciver',array(
                    'reID'=>$id,
                    'noteID'=>$noteID
                ));
                break;
            case 2:
                if($type==1){
                    $this->database->get('teachergroup',array('code','=',$this->courseId));
                    $rows2=$this->database->resultset();
                    $size=$this->database->rowCount();
                    for($i=0;$i<$size;$i++){
                    $this->database->insert('reciver',array(
                    'reID'=>$rows2[$i]['teacherId'],
                    'noteID'=>$noteID
                    ));
                    }
                    
                }
                if ($type==2) {
                  $this->database->get('coursegroup',array('courseId','=',$this->courseId));
                    $rows3=$this->database->resultset();
                    $size=$this->database->rowCount();
                    for($i=0;$i<$size;$i++){
                    $this->database->insert('reciver',array(
                    'reID'=>$rows3[$i]['ST_ID'],
                    'noteID'=>$noteID
                    ));
                    }  
                }
                break;
        }
    }
    
    public function getnotes($id) {
        $this->database->get('reciver',array('reID','=',$id));
        $rows=  $this->database->resultset();
        $size=$this->database->rowCount();
        for($i=0;$i<$size;$i++){
            $this->database->get('notification',array('id','=','noteID'));
            $rows2=  $this->database->resultset();
            $this->database->get('users',array('id','=',$id));
            $rows3=  $this->database->resultset();
            $this->database->get('periority',array('id','=',$rows2[0]['periorityID']));
            $rows4=  $this->database->resultset();
             echo "<table border=0>"
                    . "<tr>"
                        ."<td>". "note:" . "</td>"
                        ."<td>". $rows2[0]['note'] ."</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td>". "sender:" . "</td>"
                        ."<td>". $rows3[0]['name'] ."</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td>". "date:" . "</td>"
                        ."<td>". $rows2[0]['date'] ."</td>"
                    ."</tr>"
                     ."<tr>"
                        ."<td>". "periority:" . "</td>"
                        ."<td>". $rows4[0]['per'] ."</td>"
                    ."</tr><br/>";
        }
    }
}

