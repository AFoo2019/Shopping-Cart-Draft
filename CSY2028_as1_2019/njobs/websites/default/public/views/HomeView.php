<?php
namespace views;

class HomeView extends \core\View{
  public $list_item;
  public $featured_list;
  public $section;
  public $temp;
  public $temp2;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->list_item   = new \core\Template('./views/templates/list_jobs.html');
    $this->featured_list = new \core\Template('./views/templates/tpl_home_featured.html');
    $this->aside = new \core\Template('./views/templates/_tpl_aside.html');
    $this->section   = new \core\Template('./views/templates/tpl_home.html');
    $this->temp = '';
    $this->temp2 = '';
    $this->title = 'home';

    foreach(array_reverse($this->model->table) as $row){
        $this->list_item->set('jobtitle',$row['jobtitle']);

        $this->list_item->set('jobdescription',$row['jobdescription']);
        $this->list_item->set('jobid',$row['id']);
        $this->list_item->set('joblocation',"£".$row['joblocation']);
        if(!empty($row['jobfeatured'])) {
          $this->featured_list->set('featured_text',$row['jobfeatured']);
          $this->temp2.=$this->featured_list->output();
        }
      if(isset($_SESSION['status'])&&$_SESSION['status']==='ADMIN'){
          $this->list_item->set('hidden','block');
      }
      else{
          $this->list_item->set('hidden','none');
      }
          $this->temp.=$this->list_item->output();
    }
    //endforeach
    $this->aside->set('aside',$this->temp2);
    $this->section->set('list',$this->temp);

    $this->content.=$this->section->output();
  }
}
?>
