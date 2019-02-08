<?php
namespace carshop;
use PDO;

class db_conn{

  public $pdo;
  public $successful;
  public $user;
  public $pass;
  public $dsn;
  public $role;

  public function __construct(){
    if (session_status() == PHP_SESSION_NONE) {
      session_start();

      $this->user = "student";
      $this->pass = "student";
      $this->dsn= "mysql:dbname=cars;host=v.je";
      $this->role='';
    try {
        $this->pdo =  new PDO($this->dsn, $this->user, $this->pass, [ 'PDO::ATTR_ERRMODE' => 'PDO::ERRMODE_EXCEPTION']);

    }
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
  }
  }
}



?>
