<?php
namespace controllers;

class JobController extends \core\Controller{
  public function __construct($model){
    parent::__construct($model);
    if(isset($_GET['param'])){
      $param=$_GET['param'];
    }
    else{
      $param='';
    }
    $this->model->listby($param);
  }
  public function apply(){
    $this->model->apply($_GET['param1'],$_GET['param2'],'id');
    // mail("arnaud.fontane@hotmail.fr","My subject","apply working");

  }
  public function listbyemail(){
      $this->model->listbyemail($_GET['param']);
  }

}
?>
