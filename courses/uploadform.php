<?php
include_once '../upload.php';
$coursename=filter_input(INPUT_GET, 'id');
$upload=new upload('fileToUpload', 'uploads/'.$coursename.'/material/');
if(!empty(filter_input(INPUT_POST, 'submit'))){
    $upload->upload();
}
?>
<html>
<body>

    <form action="uploadform.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

</body>
</html> 