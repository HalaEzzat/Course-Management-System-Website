<?php
$thelist='';
 if ($handle = opendir('uploads/cs')) {
   while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != "..") {
            $thelist .= '<li><a href="uploads/cs/'.$file.'">'.$file.'</a></li>';
          }
       }
  closedir($handle);
  }
?>
<h1>material:</h1>
<ul><?php echo $thelist; ?></ul>