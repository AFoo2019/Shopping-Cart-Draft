<?php
namespace views;

class AccountView extends \core\View{
  public $list_item;
  public $section;
  public $temp;

  public function __construct($route, $model) {
    parent::__construct($route,$model);
    $this->list_item   = new \core\Template('./views/templates/list_accounts.html');
    $this->section   = new \core\Template('./views/templates/tpl_account.html');
    $this->temp = '';

    foreach($this->model->table as $key => $row){
        $this->list_item->set('firstname',$row['firstname']);
        $this->list_item->set('sirname',$row['sirname']);
        $this->list_item->set('email',$row['email']);
        $this->list_item->set('password',$row['password']);
        $this->list_item->set('accountid',$row['id']);
        $this->temp.=$this->list_item->output();
      }
      $this->section->set('list',$this->temp);
      $this->content.=$this->section->output();
    }
    //endforeach
  }
?>
