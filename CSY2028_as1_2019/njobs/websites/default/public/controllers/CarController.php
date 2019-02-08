<?php
namespace controllers;

class CarController extends \core\Controller{
  public function __construct($model){
    parent::__construct($model);
  }

  public function archive(){
    $this->model->archive($this->model->TABLE_NAME, 'id',$_POST[$this->model->TABLE_NAME]['id']);
    // header('Location:?route='.$this->model->TABLE_NAME.'');
  }
  // public function listbymanufacturer() {
  //   return $this->model->find($this->model->TABLE_NAME,$this->model->manufacturer,$_GET['param']);
  // }
  public function save(){
    parent::save();

  }
  public function uploadimages(){

    $target_dir = "./images/cars/";
    var_dump($_FILES["my_file"]["size"] );

$uploadOk = 1;

// Check if image file is a actual image or fake image
for($i=0; $i<count($_FILES['my_file']['name']); $i++) {
  $target_file = $target_dir . basename($_FILES["my_file"]["name"][$i]);


  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $target_file = $target_dir .$_POST[$this->model->TABLE_NAME]['id'] .'-'. $i . '.' .$imageFileType;

  // $target_file = $target_dir . basename($_FILES["my_file"]["name"][$i]);
  // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {


    $check = getimagesize($_FILES["my_file"]["tmp_name"][$i]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["my_file"]["size"][$i] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["my_file"]["name"][$i]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
  }


}
?>
