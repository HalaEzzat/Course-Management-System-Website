<?php
class upload{
    private $filename,
            $location;
 
    
    public function __construct($filename=null,$location=null) {
        $this->filename=$filename;
        $this->location=$location;
    }
    
    public function upload() {
    $target_dir = $this->location;
    $target_file = $target_dir . basename($_FILES["$this->filename"]["name"]);
    $uploadOk = 1;
    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["$this->filename"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["$this->filename"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["$this->filename"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }

    }
    
    public function listuploaded() {
    $files1 = scandir($this->location);
    for($i=2;$i<COUNT($files1);$i++){
        echo '<a href="'.$this->location.''.$files1[$i].'">'.$files1[$i].'</a>';
        echo '<br>';
    }
    }
  
    
   
    
}