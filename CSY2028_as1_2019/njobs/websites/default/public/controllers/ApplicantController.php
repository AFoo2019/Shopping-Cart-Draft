<?php
namespace controllers;

class ApplicantController extends \core\Controller{
  public function __construct($model){
    parent::__construct($model);
  }

  public function apply(){
    if(isset($_SESSION['admin'])){
      $this->model->apply();
      // header('Location:?route='.$this->model->TABLE_NAME.'');
      parent::save();

      header('Location:?route=applicantsbyjob&jobid='.$_GET['jobid'].'');
    }
    else{
      header('Location:?route=applicantregister');
    }

  }
  public function delete(){
      $this->model->delete('applicantjobs','applicantid',$_GET['applicantid']);
      parent::delete();
      header('Location:?route=applicantsbyjob&jobid='.$_GET['jobid'].'');
  }
}
?>
