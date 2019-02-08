<?php
namespace views;

class AccessView extends \core\View{

  public function __construct($route, $model) {
      parent::__construct($route,$model);
      $this->form   = new \core\Template('./views/templates/tpl_access.html');
      $this->content.=$this->form->output();
    }
  }
  ?>
