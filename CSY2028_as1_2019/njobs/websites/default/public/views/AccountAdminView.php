<?php
namespace views;

class AccountAdminView extends \core\View{
  public $form;
  public $row;

  public function __construct($route, $model) {
      parent::__construct($route,$model);
      $this->form   = new \core\Template('./views/templates/admin_accounts_tpl.html');

      if (isset($_GET['id'])) {
        $this->row=$this->model->find('accounts','id',$_GET['id']);
      }
      else {
        $this->row = null;
      }
      $this->form->set('firstname',$this->row['firstname']);
      $this->form->set('sirname',$this->row['sirname']);
      $this->form->set('email',$this->row['email']);
      $this->form->set('password',$this->row['password']);

      $this->content.=$this->form->output();
    }
  }
  ?>
