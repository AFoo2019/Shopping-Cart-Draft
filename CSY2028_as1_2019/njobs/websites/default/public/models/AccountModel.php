<?php
namespace models;

class AccountModel extends \core\Model{

  public function __construct($pdo){
    $this->TABLE_NAME='accounts';
    parent::__construct($pdo,$this->TABLE_NAME);
  }
}
?>
