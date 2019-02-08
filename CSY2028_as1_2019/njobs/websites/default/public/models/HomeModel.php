<?php
namespace models;

class HomeModel extends \core\Model{
  public $TABLE_NAME;
  public function __construct($pdo){
    $this->TABLE_NAME='stories';
    parent::__construct($pdo,$this->TABLE_NAME);
  }
}
?>
