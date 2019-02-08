<?php
namespace views;

class ApplicantRegisterView extends \core\View{
  public $form;
  public $row;

  public function __construct($route, $model) {
      parent::__construct($route,$model);
      $this->form   = new \core\Template('./views/templates/tpl_applicant_register.html');
      $this->form->set('jobid', $_GET['jobid']);
      $this->form->set('applicantid', $_GET['applicantid']);
      $this->form->set('sirname',date("Y-m-d"));
      foreach($this->model->findValues('id','applicantjobs','applicantid',$_GET['applicantid'])as $key =>$row1){
        $this->form->set('applicantjobsid',$row1['id']);
        var_dump($row1['id']);
      }
      foreach($this->model->find('applicants','id',$_GET['applicantid'])as $key => $row){
        $this->form->set('firstname',$row['applicantfname']);

        $this->form->set('applicantemail',$row['applicantemail']);
        $this->form->set('applicantpassword',$row['applicantpassword']);

        // $linkcontent=''.$row['applicantfname'].'   '.$row['applicantsname'].' - '.$row['applicantemail'].'';
        // $linkrte='?route=jobss&action=apply&param1='.$row['id'].'&param2='.$_GET['id'].'';
        // $this->form->set('applicant','<a class="nav-link nav-item" href="'.$linkrte.'">'.$linkcontent.'</a>');
      }
      $this->content.=$this->form->output();
    }
  }
  ?>
