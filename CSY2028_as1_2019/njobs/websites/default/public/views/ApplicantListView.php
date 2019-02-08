<?php
namespace views;

class ApplicantListView extends \core\View{
  public $list_item;
  public $section;
  public $temp;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->section   = new \core\Template('./views/templates/tpl_applicant_list.html');
    $this->temp = '';
    foreach($this->model->findAll('applicants') as $key => $row){

        $linkcontent=''.$row['applicantfname'].'   '.$row['applicantsname'].' - '.$row['applicantemail'].'';
        $linkrte='?route=jobss&action=listbyemail&param='.$row['applicantemail'].'';
        $this->section->set('applicant','<a class="nav-link nav-item" href="'.$linkrte.'">'.$linkcontent.'</a>');

        $this->temp.=$this->section->output();
      }
      //endif
      $this->section->set('applicant',$this->temp);
      $this->content.=$this->section->output();
    }
}
?>
