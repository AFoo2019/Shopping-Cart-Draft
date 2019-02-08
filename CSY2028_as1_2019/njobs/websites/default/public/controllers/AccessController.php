<?php
namespace controllers;

class AccessController extends \core\Controller{
  public function __construct($model){
    parent::__construct($model);
  }
  public function test(){

    $hash=$this->model->findValues('password','accounts','email',$_POST['accounts']['email'])[0]['password'];
    var_dump($hash);
    var_dump(password_hash('test', PASSWORD_DEFAULT));
    foreach($this->model->table as $row){

      if (password_verify($_POST['accounts']['password'],$hash)&&$_POST['accounts']['email']===$row['email']) {
        $_SESSION['loggedin']=true;
        $_SESSION['admin']=$row['email'];
        $_SESSION['status']=$row['status'];
        header('Location:?route=jobss');
      }
    }
}
  public function save(){
    $_POST['accounts']['password']=password_hash($_POST['accounts']['password'], PASSWORD_DEFAULT);
    parent::save($_POST['accounts']);

  }
  public function logout(){
    echo('logout');
    echo($_SESSION['loggedin']);
    unset($_SESSION['loggedin']);
    // unset($_SESSION['user']);
    unset($_SESSION['admin']);
    unset($_SESSION['status']);
    session_destroy();
    header('Location:?route=jobss');
  }
}
?>
