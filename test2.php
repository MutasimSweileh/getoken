<?php
$target_dir = "uploads/";
$target_file = $target_dir .basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $type = $_FILES["fileToUpload"]["type"];
  /*  $name = explode(".", $filename);
    $target_path = "../".$filename;*/

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_FILES["fileToUpload"]["error"] == 0){
    print_r($_FILES["fileToUpload"]);

     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file. ".$_FILES["fileToUpload"]["tmp_name"];
    }
    }else{
    echo "Error :".$_FILES["fileToUpload"]["error"];

    }
    }
/*if(isset($_POST["submit"])) {
if($_FILES["fileToUpload"]["error"] == 0){
    //$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }else{
    echo  $_FILES["fileToUpload"]["error"];

    }
}   */
?>
<!DOCTYPE html>
<html>
<body>

<form action="test2.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000000000000" />
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
