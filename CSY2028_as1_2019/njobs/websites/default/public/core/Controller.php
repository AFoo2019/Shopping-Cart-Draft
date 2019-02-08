<?php
namespace core;

class Controller {
   public $model;
   public function __construct($model) {
      $this->model = $model;

  }
  public function list() {
    return $this->model->findAll();
    header('Location:?route='.$this->model->TABLE_NAME.'');
  }
  public function delete() {
    $this->model->delete($this->model->TABLE_NAME,'id',$_POST[$this->model->TABLE_NAME]['id']);
    header('Location:?route='.$this->model->TABLE_NAME.'');
  }
  public function save() {
    $this->model->save($this->model->TABLE_NAME, $_POST[$this->model->TABLE_NAME],'id');
    header('Location:?route='.$this->model->TABLE_NAME.'');
  }
  public function add() {
    $this->model->save($this->model->TABLE_NAME, $_POST[$this->model->TABLE_NAME]);
    header('Location:?route='.$this->model->TABLE_NAME.'');
  }
}
?>
