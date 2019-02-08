<?php
namespace views;

class JobFilteredView extends \core\View{
  public $list_item;
  public $section;
  public $temp;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->section   = new \core\Template('./views/templates/tpl_job_filtered_list.html');
    $this->list_item   = new \core\Template('./views/templates/list_jobs.html');
    $this->temp = '';


    foreach($this->model->joblist as $row){




        $this->list_item->set('jobtitle',$row['jobtitle']);
        $this->list_item->set('jobdescription',$row['jobdescription']);
        $this->list_item->set('joblocation',"£".$row['joblocation']);
        $this->list_item->set('jobid',$row['id']);
        $this->temp.=$this->list_item->output();


    }
    //endforeach
    $this->section->set('jobs',$this->temp);
    $this->content.=$this->section->output();
  }
}
?>
