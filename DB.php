<?php
include_once 'config.php';
class DB{
    private static $_instance=null;
    private $_pdo;
    private $error;
    private $stmt;
    private $results;
    private $count;


    //constructor
    private function __construct(){
     try{
         $this->_pdo=new PDO('mysql:localhost=' . config::get('mysql/host') . ';dbname=' . config::get('mysql/db'), config::get('mysql/username'), config::get('mysql/password'));
     } catch (PDOException $ex) {
         die($ex->getMessage());
     }
    }
    
    public static function getInstance() {
        if(!isset(self::$_instance)){
            self::$_instance=new DB;
        }
        return self::$_instance;
    }
    
    public function query($sql,$params=  array()){
    $this->error=FALSE;
    if($this->stmt=$this->_pdo->prepare($sql)){
        $x=1;
        if(count($params)){
        foreach ($params as $param){
            $this->stmt->bindValue($x, $param);
            $x++;
        }
        }
    if($this->stmt->execute()){
        $this->count=  $this->stmt->rowCount();
    }else{
        $this->error=TRUE;
    }
    }
    return $this;
        }
        
        public function error() {
            return $this->error;
        }
    
    public function action($action,$table,$where = array()) {
        if(count($where)===3){
            $operators=array('=','<','>','<=','>=');
            
            $field      =$where[0];
            $operator   =$where[1];
            $value      =$where[2];
            
            if(in_array($operator, $operators)){
                $sql="{$action} from {$table} where {$field} {$operator} ?";
                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }
        }
        return FALSE;
    }
    
    public function get($table,$where) {
        return $this->action('select*', $table,$where);
    }
    
    public function update($table,$id,$fields) {
        $set='';
        $x=1;
        
        //set
        foreach ($fields as $name => $value){
            $set .= "{$name} = ?";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }
        
        $sql="update {$table} set {$set} where id={$id}";
        
        if(!$this->query($sql, $fields)->error()){
            return TRUE;
        }
        return FALSE;
    }
    public function insert($table,$fields=array()) {
        if(count($fields)){
            $keys=  array_keys($fields);
            $values=NULL;
            $x=1;
            
            foreach ($fields as $field){
                $values .= '?';
                if($x < count($fields)){
                    $values .=', ';
                }
                $x++;
                }
                
            
            
            $sql="insert into {$table} (`" .  implode('`, `',$keys). "`) values ({$values})";
            
            if(!$this->query($sql, $fields)->error()){
                return TRUE;
        }
        }
        return FALSE;
    }
    
    public function delete($table,$where) {
        return $this->action('delete', $table,$where);   
    }
    
    public function count() {
        return $this->count;
    }
    
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
  switch (true) {
    case is_int($value):
      $type = PDO::PARAM_INT;
      break;
    case is_bool($value):
      $type = PDO::PARAM_BOOL;
      break;
    case is_null($value):
      $type = PDO::PARAM_NULL;
      break;
    default:
      $type = PDO::PARAM_STR;
  }
}
 $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute(){
    return $this->stmt->execute();
}

public function resultset(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
}

public function rowCount(){
    return $this->stmt->rowCount();
}

public function lastInsertId(){
    return $this->_pdo->lastInsertId();
}

public function beginTransaction(){
    return $this->_pdo->beginTransaction();
}

public function endTransaction(){
    return $this->_pdo->commit();
}

public function cancelTransaction(){
    return $this->_pdo->rollBack();
}

public function debugDumpParams(){
    return $this->stmt->debugDumpParams();
}
 
}