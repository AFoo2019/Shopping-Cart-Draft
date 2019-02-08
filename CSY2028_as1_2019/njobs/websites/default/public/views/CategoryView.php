<?php
namespace views;

class CategoryView extends \core\View{
  public $list_item;
  public $section;
  public $temp;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->list_item   = new \core\Template('./views/templates/list_category.html');
    $this->section   = new \core\Template('./views/templates/tpl_category.html');
    $this->temp = '';

    foreach($this->model->table as $key => $row){
        $this->list_item->set('category',$row['category']);
        $this->list_item->set('categoryid',$row['id']);
        $this->temp.=$this->list_item->output();
      }
      $this->section->set('list',$this->temp);
      $this->content.=$this->section->output();
    }
    //endforeach
  }
?>
