<?php
namespace models;

  class CategoryModel extends \core\Model{
    public $manufacturers;

    public function __construct($pdo){
      $this->TABLE_NAME='categories';
      parent::__construct($pdo,$this->TABLE_NAME);
  }
}
?>
