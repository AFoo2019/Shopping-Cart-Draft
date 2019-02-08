<?php
namespace core;

class FrontController {
    private $controller;
    private $view;
    private $conn;
    private $pdo;
    private $output;

    public function __construct(\carshop\Routes $routes, $routeName, $action = null) {

        $route = $routes->getRoute($routeName);
        $this->conn=new \carshop\db_conn();
        $this->pdo=$this->conn->pdo;
        $modelName = '\\models\\' .$route->model;
        $controllerName = '\\controllers\\' .$route->controller;
        $viewName = '\\views\\' .$route->view;

        $model = new $modelName($this->pdo);
        $this->controller = new $controllerName($model);
        $this->view = new $viewName($routeName, $model);

        // if(in_array('login',$routes->table[$routeName][1]) && !isset($_SESSION['loggedin'])){
        //
        //   header('Location:?route=stories');
        // }
        if (!isset($_SESSION['loggedin'])) {
          $this->output= preg_replace('/<HIDE>[\s\S]+?<HIDE->/','', $this->view->output());
        }
        else if ($_SESSION['status']!="ADMIN") {
          $this->output= preg_replace('/<AHIDE>[\s\S]+?<AHIDE->/','', $this->view->output());
        }
        else{
          $this->output= $this->view->output();
        }

        if (!empty($action)) $this->controller->{$action}();
    }

    public function output() {
      return $this->output;
    }
}
?>
