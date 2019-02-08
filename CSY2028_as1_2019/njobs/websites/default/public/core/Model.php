<?php
namespace core;
use \Exception as Exception;

class Model{

  public $TABLE_NAME;
  public $pdo;
  public $table;

  public function __construct($pdo,$TABLE_NAME) {
    $this->TABLE_NAME=$TABLE_NAME;
    $this->pdo=$pdo;
    $this->table = $this->findAll($this->TABLE_NAME);
  }
  public function findAll($TABLE_NAME){
    $stmt = $this->pdo->prepare('SELECT * FROM '.$TABLE_NAME.'');
    $stmt->execute();
    return $stmt->fetchAll();
  }
  public function find($TABLE_NAME, $field, $value) {
      $stmt = $this->pdo->prepare('SELECT * FROM ' . $TABLE_NAME . ' WHERE ' . $field . ' = :value');
      $criteria = [ 'value' => $value ];
      $stmt->execute($criteria);
      return $stmt->fetchAll();
  }
    public function findValues($columns, $TABLE_NAME, $field, $value) {
      $stmt = $this->pdo->prepare('SELECT '. $columns.' FROM ' . $TABLE_NAME . ' WHERE ' . $field . ' = :value');
      $criteria = [ 'value' => $value ];
      $stmt->execute($criteria);
      return $stmt->fetchAll();
  }
  public function update($TABLE_NAME, $record, $primaryKey) {
     $query = 'UPDATE ' . $TABLE_NAME . ' SET ';
     $parameters = [];
     foreach ($record as $key => $value) {
        $parameters[] = $key . ' = :' .$key;
      }
      $query .= implode(', ', $parameters);
      $query .= ' WHERE ' . $primaryKey . ' = :id';
      $record['id'] = $record[$primaryKey];
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($record);
  }
  public function insert($TABLE_NAME, $record) {

    $this->pdo->query(' SET FOREIGN_KEY_CHECKS=0');
    $keys = array_keys($record);
    $values = implode(', ', $keys);
    $valuesWithColon = implode(', :', $keys);
    $query = 'INSERT INTO ' . $TABLE_NAME . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';
    $stmt = $this->pdo->prepare($query);
    $stmt->execute($record);
    $this->pdo->query(' SET FOREIGN_KEY_CHECKS=1');
  }
  public function delete($TABLE_NAME, $field, $value) {
      $this->pdo->query('SET FOREIGN_KEY_CHECKS=0');

      $stmt = $this->pdo->prepare('DELETE FROM ' . $TABLE_NAME . ' WHERE ' . $field . ' = :value');
      $criteria = [ 'value' => $value ];
      $stmt->execute($criteria);
      return $stmt->fetch();
      $this->pdo->query(' SET FOREIGN_KEY_CHECKS=1');

  }
  public function save($TABLE_NAME, $record, $primaryKey){
    try {

      $this->insert($TABLE_NAME, $record);
      throw new Exception('Some Error Message');
    }
    catch (\Exception $e){

      $this->update($TABLE_NAME, $record, $primaryKey);
      var_dump($e->getMessage());
     }
   }
}
?>
