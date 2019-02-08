<?php
namespace core;

class View {

    public $layout;
    public $adminsection;
    public $model;
    public $route;
    public $content;
    public $title;
    public $subtitle;
    public $categories;
    public $categorylist;
    public function __construct($route, $model) {
        $this->route = $route;
        $this->model = $model;
        $this->layout= new Template('./views/templates/_tpl_layout.html');
        $this->adminsection= new Template('./views/templates/_tpl_admin_sidebar.html');
        $this->aside=new Template('./views/templates/_tpl_aside.html');
        $this->content='';
        $this->title=$model->TABLE_NAME;
        $this->subtitle='';

        $temp='';
        $this->temp2='';
        $this->categories=$this->model->findAll('categories');

        foreach($this->categories as $row){
          $link='<a class="dropdown-item" href="?route=jobfilteredlist&param='.$row["id"].'">'.$row["category"].'</a>';
          $temp.=$link;
        }
        $this->categorylist=$temp;
    }
    public function output(){
      foreach($this->model->findAll('jobss')as $k => $v){
            if(!empty($row['jobfeatured'])) {
            $this->aside->set('aside',$row['jobfeatured']);
            $this->temp2.=$this->aside->output();
          }
      }
      $this->layout->set('title',$this->title);
      $this->layout->set('subtitle',$this->subtitle);
      $this->layout->set('content',$this->content);
      $this->layout->set('categorylist',$this->categorylist);
      $this->layout->set('aside',$this->temp2);

      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          $this->layout->set('accessroute',"?route=access&action=logout");
          $this->layout->set('access',"logout");
          if (isset($_SESSION['admin'])) {
            $this->layout->set('adminsection',$this->adminsection->output());
          }
      }
      else{
        $this->layout->set('accessroute',"?route=access");
        $this->layout->set('access',"login");
      }


          // $this->layout->set('categorylist',$this->categories);

      return $this->layout->output();
    }
  }
?>
