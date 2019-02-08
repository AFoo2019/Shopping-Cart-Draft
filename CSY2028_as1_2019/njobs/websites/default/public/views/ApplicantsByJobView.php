<?php
namespace views;

class ApplicantsByJobView extends \core\View{
  public $list_item;
  public $section;
  public $temp;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->section   = new \core\Template('./views/templates/tpl_applicant_list.html');
    $this->temp = new \core\Template('./views/templates/tpl_applicant_list_wrpr.html');
    $gen_applicantid=0;
    foreach($this->model->findAll('applicants')as $key => $row){
      if ($row['id']>$gen_applicantid) $gen_applicantid=$row['id'];

    }
    $this->temp->set('jobid',$_GET['jobid']);
    $this->temp->set('applicantid',$gen_applicantid+1);
    $this->section->set('jobid',$_GET['jobid']);

    $this->temp = $this->temp->output();
    foreach($this->model->find('applicantjobs','jobid',$_GET['jobid'])as $key => $row1){
          foreach($this->model->find('applicants','id',$row1['applicantid'])as $key => $row){

          $this->section->set('applicantid',$row['id']);
          $this->section->set('applicantfname',$row['applicantfname']);
          $this->section->set('applicantsname',$row['applicantsname']);
          $this->section->set('applicantemail',$row['applicantemail']);
          $this->section->set('applicantpassword',$row['applicantpassword']);
          $this->section->set('applicantid_edit',$row1['applicantid']);

        // $linkcontent=''.$row['applicantfname'].'   '.$row['applicantsname'].' - '.$row['applicantemail'].'';
        // $linkrte='?route=jobss&action=apply&param1='.$row['id'].'&param2='.$_GET['id'].'';
        // $this->section->set('applicant','<a class="nav-link nav-item" href="'.$linkrte.'">'.$linkcontent.'</a>');

        $this->temp.=$this->section->output();
      }
      }
      //endif
      $this->temp.="</ul>";
      $this->content.=$this->temp;
    }

}
?>
