<?php
namespace views;

class ApplicantAccountView extends \core\View{
  public $list_item;
  public $section;
  public $temp;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->list_item   = new \core\Template('./views/templates/list_jobs.html');
    $this->section   = new \core\Template('./views/templates/tpl_applicantaccount.html');
    $this->temp = '';

    $this->list_item->set('applicantfname',$this->model->findValues('applicantfname','applicants','applicantemail',$_SESSION['user']));
    $this->list_item->set('applicantsname',$this->model->findValues('applicantsname','applicants','applicantemail',$_SESSION['user']));
    $this->list_item->set('applicantemail',$_SESSION['user']);
    foreach(array_reverse($this->model->find('jobs')) as $row){
        $aid=$this->model->findValues('id','applicants','applicantemail',$_SESSION['user']);

        $this->list_item->set('jobapplicantid',$aid);
        $this->list_item->set('jobtitle',$row['jobtitle']);
        $this->list_item->set('jobcategory',$this->model->findValues('category','categories','id',$row['categoryid'])[0]);
        $this->list_item->set('jobdescription',$row['jobdescription']);
        $this->list_item->set('jobid',$row['id']);
        $this->temp.=$this->list_item->output();
    }
    //endforeach
    $this->section->set('list',$this->temp);
    $this->content.=$this->section->output();
  }
}
?>
