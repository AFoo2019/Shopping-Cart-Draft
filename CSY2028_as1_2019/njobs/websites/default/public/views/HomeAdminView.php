<?php
namespace views;

class HomeAdminView extends \core\View{
  public $form;
  public $row;


  public function __construct($route, $model) {
    //for testing only
      $_SESSION['user']=3;
      parent::__construct($route,$model);
      $this->form   = new \core\Template('./views/templates/admin_stories_tpl.html');

      if (isset($_GET['id'])) {
        $this->row=$this->model->find('stories','id',$_GET['id']);
        $this->form->set('authorid',$this->row['accountid']);
      }
      else {
        $this->row = null;
      }
      $this->form->set('accountid',$_SESSION['user']);
      $this->form->set('storyid',$this->row['id']);
      $this->form->set('title',$this->row['title']);
      $this->form->set('subtitle',$this->row['subtitle']);
      $this->form->set('content',$this->row['content']);
      $this->form->set('authorid', $this->model->findValues('id','accounts','email',$_SESSION['admin'])[0][0]);
      var_dump($this->model->findValues('id','accounts','email',$_SESSION['admin'])[0][0]);

      $this->content.=$this->form->output();
    }
  }
  ?>
